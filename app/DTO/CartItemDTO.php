<?php

namespace App\DTO;

class CartItemDTO
{
    public function __construct(
        public $userId,
        public $productId,
        public $quantity
    )
    {}

}
