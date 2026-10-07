<?php

namespace App\Modules\Customer\DTO;

class CustomerDTO
{
    public function __construct(
        public readonly string $code,
        public readonly string $name,
        public readonly ?string $phone,
        public readonly ?string $email,
        public readonly ?string $address,
        public readonly int $point,
        public readonly bool $status,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            code: $data['code'],
            name: $data['name'],
            phone: $data['phone'] ?? null,
            email: $data['email'] ?? null,
            address: $data['address'] ?? null,
            point: (int) ($data['point'] ?? 0),
            status: (bool) ($data['status'] ?? true),
        );
    }

    public function toArray(): array
    {
        return [
            'code' => $this->code,
            'name' => $this->name,
            'phone' => $this->phone,
            'email' => $this->email,
            'address' => $this->address,
            'point' => $this->point,
            'status' => $this->status,
        ];
    }
}