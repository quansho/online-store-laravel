<?php

namespace App\Handlers;

use App\Commands\Product\GetFilteredProductsQuery;
use App\Repositories\ProductRepositoryInterface;

class GetAllProductsQueryHandler
{
    public function __construct(
        protected ProductRepositoryInterface $productRepository
    )
    {}

    public function handle(GetFilteredProductsQuery $query): array
    {
        return $this->productRepository->getFilteredProducts($query->filter)->toArray();
    }
}
