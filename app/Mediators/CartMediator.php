<?php

namespace App\Mediators;

use App\Commands\Cart\AddToCart;
use App\Commands\Cart\GetCart;
use App\Commands\Cart\RemoveFromCart;
use App\Handlers\AddToCartCommandHandler;
use App\Handlers\GetUserCartQueryHandler;
use App\Handlers\RemoveFromCartCommandHandler;


class CartMediator extends Mediator
{
    function registerSelfCommands(): void
    {
        $this->registerHandler(GetCart::class, GetUserCartQueryHandler::class);
        $this->registerHandler(AddToCart::class, AddToCartCommandHandler::class);
        $this->registerHandler(RemoveFromCart::class, RemoveFromCartCommandHandler::class);
    }
}
