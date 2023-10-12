<?php

namespace App\Handlers;

use App\Commands\Product\CreateProductCommand;
use App\Repositories\ProductRepositoryInterface;

class CreateProductCommandHandler
{
    public function __construct(
        protected ProductRepositoryInterface $productRepository
    )
    {}

    public function handle(CreateProductCommand $command): \App\Models\Product
    {
        return $this->productRepository->create($command->productDTO);
    }
}
