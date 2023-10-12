<?php

namespace App\Commands\Product;

use App\DTO\ProductFilterDTO;

class GetFilteredProductsQuery
{
    public function __construct(public ProductFilterDTO $filter)
    {}
}
