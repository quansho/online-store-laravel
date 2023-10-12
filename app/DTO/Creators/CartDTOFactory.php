<?php

namespace App\DTO\Creators;

use App\DTO\CartDTO;
use App\DTO\CartItemDTO;

class CartDTOFactory
{
    public static function createCartDTO($userId, $cartItems): CartDTO
    {
        $items = [];
        foreach ($cartItems as $cartItem) {
            $items[] = new CartItemDTO($userId, $cartItem->product_id, $cartItem->quantity);
        }

        return new CartDTO($userId, $items);
    }
}
