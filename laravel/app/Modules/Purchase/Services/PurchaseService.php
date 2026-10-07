<?php

namespace App\Modules\Purchase\Services;

use App\Exceptions\PurchaseException;
use App\Models\Product;
use App\Models\Purchase;
use App\Modules\Purchase\DTO\PurchaseDTO;
use App\Modules\Purchase\Repositories\PurchaseRepositoryInterface;
use App\Services\InvoiceService;
use App\Services\StockService;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class PurchaseService
{
    public function __construct(
        protected PurchaseRepositoryInterface $repository,
        protected InvoiceService $invoiceService,
        protected StockService $stockService,
    ) {
    }

    public function create(PurchaseDTO $dto): Purchase
    {
        return DB::transaction(function () use ($dto) {

            /*
            |--------------------------------------------------------------------------
            | 1. Load products
            |--------------------------------------------------------------------------
            */

            $products = $this->loadProducts($dto);

            /*
            |--------------------------------------------------------------------------
            | 2. Validate products
            |--------------------------------------------------------------------------
            */

            $this->validateProducts($dto, $products);

            /*
            |--------------------------------------------------------------------------
            | 3. Calculate totals
            |--------------------------------------------------------------------------
            */

            $subtotal = $this->calculateSubtotal($dto);

            $discount = $dto->discount;
            $tax = $dto->tax;

            if ($discount > $subtotal) {
                throw new PurchaseException(
                    'Discount tidak boleh lebih besar dari subtotal.'
                );
            }

            $grandTotal = $subtotal - $discount + $tax;

            if ($grandTotal < 0) {
                throw new PurchaseException(
                    'Grand total pembelian tidak boleh negatif.'
                );
            }

            /*
            |--------------------------------------------------------------------------
            | 4. Generate invoice
            |--------------------------------------------------------------------------
            */

            $invoice = $this->invoiceService->generate('purchase');

            /*
            |--------------------------------------------------------------------------
            | 5. Create purchase
            |--------------------------------------------------------------------------
            */

            $purchase = $this->repository->create([
                'invoice_number' => $invoice,
                'supplier_id' => $dto->supplier_id,
                'user_id' => auth()->id(),
                'subtotal' => $subtotal,
                'discount' => $discount,
                'tax' => $tax,
                'grand_total' => $grandTotal,
                'payment_method' => $dto->payment_method,
                'payment_status' => 'paid',
                'notes' => $dto->notes,
            ]);

            /*
            |--------------------------------------------------------------------------
            | 6. Create purchase items + increase stock
            |--------------------------------------------------------------------------
            */

            $this->processItems(
                purchase: $purchase,
                dto: $dto,
                products: $products,
            );

            /*
            |--------------------------------------------------------------------------
            | 7. Return fresh data
            |--------------------------------------------------------------------------
            */

            return $purchase->fresh([
                'supplier',
                'user',
                'items.product',
            ]);
        });
    }

    private function loadProducts(
        PurchaseDTO $dto
    ): Collection {
        $ids = collect($dto->items)
            ->pluck('product_id')
            ->unique()
            ->sort()
            ->values();

        return Product::whereIn('id', $ids)
            ->lockForUpdate()
            ->get()
            ->keyBy('id');
    }

    private function validateProducts(
        PurchaseDTO $dto,
        Collection $products
    ): void {
        foreach ($dto->items as $item) {

            if (! $products->has($item->product_id)) {
                throw new PurchaseException(
                    "Produk {$item->product_id} tidak ditemukan."
                );
            }

            if ($item->qty <= 0) {
                throw new PurchaseException(
                    "Jumlah produk {$item->product_id} tidak valid."
                );
            }

            if ($item->price < 0) {
                throw new PurchaseException(
                    "Harga produk {$item->product_id} tidak valid."
                );
            }
        }
    }

    private function calculateSubtotal(
        PurchaseDTO $dto
    ): float {
        return collect($dto->items)
            ->sum(
                fn ($item) => $item->qty * $item->price
            );
    }

    private function processItems(
        Purchase $purchase,
        PurchaseDTO $dto,
        Collection $products
    ): void {
        foreach ($dto->items as $item) {

            $product = $products->get($item->product_id);

            $subtotal = $item->qty * $item->price;

            /*
            |--------------------------------------------------------------------------
            | Create purchase item
            |--------------------------------------------------------------------------
            */

            $this->repository->createItem([
                'purchase_id' => $purchase->id,
                'product_id' => $product->id,
                'qty' => $item->qty,
                'price' => $item->price,
                'subtotal' => $subtotal,
            ]);

            /*
            |--------------------------------------------------------------------------
            | Increase stock
            |--------------------------------------------------------------------------
            */

            $this->stockService->increase(
                product: $product,
                qty: $item->qty,
                referenceType: 'purchase',
                referenceId: $purchase->id,
                notes: 'Pembelian ' . $purchase->invoice_number,
            );

            /*
            |--------------------------------------------------------------------------
            | Update latest cost price
            |--------------------------------------------------------------------------
            */

            $product->update([
                'cost_price' => $item->price,
            ]);
        }
    }

    public function getAll(): Collection
    {
        return $this->repository->all();
    }

    public function find(int $id): Purchase
    {
        return $this->repository->find($id);
    }
}
