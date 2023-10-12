<?php

namespace App\Commands\Product;

use App\DTO\ProductDTO;

class UpdateProductCommand
{
    public function __construct(
        public $product,
        public ProductDTO $productDTO
    )
    {}
}
