<?php

namespace App\DTO;

class CartDTO
{
    public function __construct(
        public $user,
        public $items
    )
    {}
}
