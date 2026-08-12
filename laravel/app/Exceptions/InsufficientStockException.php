<?php

namespace App\Exceptions;

use Exception;

class InsufficientStockException extends Exception
{
    public function __construct(string $productName)
    {
        parent::__construct(
            "Stock produk {$productName} tidak mencukupi."
        );
    }
}