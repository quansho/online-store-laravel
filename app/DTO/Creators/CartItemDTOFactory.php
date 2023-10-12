<?php

namespace App\DTO\Creators;

use App\DTO\CartItemDTO;

class CartItemDTOFactory
{
    public static function create($userId, $productId, $quantity): CartItemDTO
    {
        return new CartItemDTO($userId,$productId, $quantity);
    }
}
