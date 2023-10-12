<?php

namespace App\Handlers;

use App\Commands\Cart\RemoveFromCart;
use App\Models\Cart;

class RemoveFromCartCommandHandler
{

    public function handle(RemoveFromCart $command): void
    {
        Cart::where('user_id', $command->cartItem->userId)->where('product_id', $command->cartItem->productId)->delete();
    }
}
