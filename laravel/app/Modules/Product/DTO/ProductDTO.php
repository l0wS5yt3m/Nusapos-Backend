<?php

namespace App\Modules\Product\DTO;

class ProductDTO
{
    public function __construct(
        public readonly int $category_id,
        public readonly string $sku,
        public readonly ?string $barcode,
        public readonly string $name,
        public readonly string $slug,
        public readonly ?string $description,
        public readonly float $cost_price,
        public readonly float $selling_price,
        public readonly int $stock,
        public readonly int $minimum_stock,
        public readonly ?string $image,
        public readonly bool $status,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            category_id: (int) $data['category_id'],
            sku: $data['sku'],
            barcode: $data['barcode'] ?? null,
            name: $data['name'],
            slug: $data['slug'],
            description: $data['description'] ?? null,
            cost_price: (float) $data['cost_price'],
            selling_price: (float) $data['selling_price'],
            stock: (int) $data['stock'],
            minimum_stock: (int) $data['minimum_stock'],
            image: $data['image'] ?? null,
            status: (bool) $data['status'],
        );
    }

    public function toArray(): array
    {
        return [
            'category_id' => $this->category_id,
            'sku' => $this->sku,
            'barcode' => $this->barcode,
            'name' => $this->name,
            'slug' => $this->slug,
            'description' => $this->description,
            'cost_price' => $this->cost_price,
            'selling_price' => $this->selling_price,
            'stock' => $this->stock,
            'minimum_stock' => $this->minimum_stock,
            'image' => $this->image,
            'status' => $this->status,
        ];
    }
}