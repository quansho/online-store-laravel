<?php

namespace App\Commands\Cart;

use App\DTO\CartItemDTO;

class AddToCart
{
    public function __construct(
        public CartItemDTO $cartItem,
    )
    {}
}
