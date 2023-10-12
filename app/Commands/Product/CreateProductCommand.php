<?php

namespace App\Commands\Product;

use App\DTO\ProductDTO;

class CreateProductCommand
{
    public function __construct(public ProductDTO $productDTO)
    {}
}
