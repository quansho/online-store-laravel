<?php

namespace App\Handlers;

use App\Commands\Product\DeleteProductCommand;
use App\Repositories\ProductRepositoryInterface;

class DeleteProductCommandHandler
{

    public function __construct(
        protected ProductRepositoryInterface $productRepository
    )
    {}

    public function handle(DeleteProductCommand $command): void
    {
        $this->productRepository->delete($command->product);
    }
}
