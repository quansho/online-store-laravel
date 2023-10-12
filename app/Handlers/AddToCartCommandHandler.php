<?php

namespace App\Handlers;

use App\Commands\Cart\AddToCart;
use App\Models\Cart;

class AddToCartCommandHandler
{
    public function handle(AddToCart $command): void
    {
        $cartItem = Cart::where('user_id', $command->cartItem->userId)->where('product_id', $command->cartItem->productId)->first();

        if ($cartItem) {
            $cartItem->update(['quantity' => $cartItem->quantity + $command->cartItem->quantity]);
        } else {
            Cart::create([
                'user_id' => $command->cartItem->quantity,
                'product_id' => $command->cartItem->productId,
                'quantity' => $command->cartItem->quantity,
            ]);
        }
    }
}
