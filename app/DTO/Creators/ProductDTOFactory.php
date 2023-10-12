<?php

namespace App\DTO\Creators;

use App\DTO\ProductDTO;

class ProductDTOFactory
{
    public static function create(...$args): ProductDTO
    {
        return new ProductDTO(...$args);
    }
}
