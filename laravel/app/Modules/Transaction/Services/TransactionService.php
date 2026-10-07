<?php

namespace App\Modules\Transaction\Services;

use App\Services\InvoiceService;
use App\Services\StockService;
use App\Services\TransactionCalculator;
use App\Modules\Transaction\DTO\TransactionDTO;
use App\Modules\Transaction\Repositories\TransactionRepositoryInterface;
use Illuminate\Support\Facades\DB;
use App\Models\Transaction;
use Illuminate\Support\Collection;

class TransactionService
{
    public function __construct(
        protected TransactionRepositoryInterface $repository,
        protected InvoiceService $invoiceService,
        protected StockService $stockService,
        protected TransactionCalculator $calculator,
    ) {
    }

    public function create(
    TransactionDTO $dto
    ): Transaction {

    return DB::transaction(

        function () use ($dto) {

            $invoice = $this->invoiceService->generate();

            // 1. Ambil semua produk
            $products = $this->loadProducts($dto);

            // 2. Validasi stok
            $this->validateStock(
                $dto,
                $products
            );

            // 3. Hitung total
            $total = $this->calculator->calculate(
                $dto->items,
                $products,
                $dto->discount,
                $dto->tax,
            );

            // 4. Simpan transaksi
            $transaction = $this->repository->create([
                'invoice_number' => $invoice,
                'customer_id' => $dto->customer_id,
                'user_id' => $dto->user_id,
                'subtotal' => $total['subtotal'],
                'discount' => $total['discount'],
                'tax' => $total['tax'],
                'grand_total' => $total['grand_total'],
                'payment_method' => $dto->payment_method,
                'payment_status' => 'paid',
                'transaction_status' => 'completed',
                'notes' => $dto->notes,
            ]);

            // 5. Simpan item & kurangi stok
            $this->processItems(
                $transaction,
                $dto,
                $products
            );

            return $transaction->fresh([
                'customer',
                'user',
                'items.product',
            ]);

        }

    );

}

   private function processItems(
    Transaction $transaction,
    TransactionDTO $dto,
    Collection $products
): void {

    foreach ($dto->items as $item) {

        $product = $products->get($item->product_id);

        $subtotal = $product->selling_price * $item->qty;

        $this->repository->createItem([
            'transaction_id' => $transaction->id,
            'product_id'     => $product->id,
            'qty'            => $item->qty,
            'price'          => $product->selling_price,
            'subtotal'       => $subtotal,
        ]);

        $this->stockService->decrease(
    product: $product,
    qty: $item->qty,
    referenceType: 'transaction',
    referenceId: $transaction->id,
    notes: 'Penjualan '.$transaction->invoice_number,
);
    }
}




private function loadProducts(
    TransactionDTO $dto
): Collection
{
    $ids = collect($dto->items)
        ->pluck('product_id')
        ->unique()
        ->sort()
        ->values();

    return \App\Models\Product::whereIn('id', $ids)
        ->lockForUpdate()
        ->get()
        ->keyBy('id');
}


private function validateStock(
    TransactionDTO $dto,
    Collection $products
): void {

    foreach ($dto->items as $item) {

        $product = $products->get($item->product_id);

        if (! $product) {
            throw new \Exception(
                "Produk {$item->product_id} tidak ditemukan."
            );
        }

        if ($product->stock < $item->qty) {
            throw new \App\Exceptions\InsufficientStockException(
                $product->name
            );
        }
    }
}

    public function getAll()
    {
        return $this->repository->all();
    }

    public function find(int $id)
    {
        return $this->repository->find($id);
    }

}