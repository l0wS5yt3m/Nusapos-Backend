<?php

namespace App\Modules\Product\DTO;


class CategoryDTO
{

    public function __construct(
        public string $name,
        public ?string $description = null,
        public bool $status = true
    ){}



    public static function fromArray(array $data): self
    {
        return new self(

            name:$data['name'],

            description:$data['description'] ?? null,

            status:$data['status'] ?? true

        );
    }


    public function toArray(): array
    {

        return [

            'name'=>$this->name,

            'description'=>$this->description,

            'status'=>$this->status

        ];

    }

}