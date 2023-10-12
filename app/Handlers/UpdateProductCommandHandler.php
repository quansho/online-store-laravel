<?php

namespace App\Handlers;

use App\Commands\Product\UpdateProductCommand;
use App\Repositories\ProductRepositoryInterface;

class UpdateProductCommandHandler
{
    public function __construct(
        protected ProductRepositoryInterface $productRepository
    )
    {}

    public function handle(UpdateProductCommand $command): \App\Models\Product
    {
        return $this->productRepository->update($command->product, $command->productDTO);
    }
}
