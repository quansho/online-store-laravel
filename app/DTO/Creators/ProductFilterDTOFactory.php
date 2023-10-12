<?php

namespace App\DTO\Creators;

use App\DTO\ProductFilterDTO;

class ProductFilterDTOFactory
{
    public static function create(...$args): ProductFilterDTO
    {
        return new ProductFilterDTO(...$args);
    }
}
