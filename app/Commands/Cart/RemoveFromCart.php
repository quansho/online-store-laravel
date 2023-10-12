<?php

namespace App\Commands\Cart;

use App\DTO\CartItemDTO;

class RemoveFromCart
{
    public function __construct(
        public CartItemDTO $cartItem,
    )
    {}
}
