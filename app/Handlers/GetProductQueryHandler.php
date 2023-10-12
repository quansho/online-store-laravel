<?php

namespace App\Handlers;

use App\Commands\Product\GetProductQuery;
use App\Repositories\ProductRepositoryInterface;

class GetProductQueryHandler
{
    public function __construct(
        protected ProductRepositoryInterface $productRepository
    )
    {}
    public function handle(GetProductQuery $query): ?\App\Models\Product
    {
        return $this->productRepository->find($query->productId);
    }
}
