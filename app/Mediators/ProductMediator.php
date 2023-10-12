<?php

namespace App\Mediators;

use App\Commands\Product\CreateProductCommand;
use App\Commands\Product\DeleteProductCommand;
use App\Commands\Product\GetFilteredProductsQuery;
use App\Commands\Product\GetProductQuery;
use App\Commands\Product\UpdateProductCommand;
use App\Handlers\CreateProductCommandHandler;
use App\Handlers\DeleteProductCommandHandler;
use App\Handlers\GetAllProductsQueryHandler;
use App\Handlers\GetProductQueryHandler;
use App\Handlers\UpdateProductCommandHandler;

class ProductMediator extends Mediator
{
    function registerSelfCommands(): void
    {
        $this->registerHandler(CreateProductCommand::class, CreateProductCommandHandler::class);
        $this->registerHandler(UpdateProductCommand::class, UpdateProductCommandHandler::class);
        $this->registerHandler(DeleteProductCommand::class, DeleteProductCommandHandler::class);
        $this->registerHandler(GetProductQuery::class, GetProductQueryHandler::class);
        $this->registerHandler(GetFilteredProductsQuery::class, GetAllProductsQueryHandler::class);
    }
}
