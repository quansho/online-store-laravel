<?php

namespace App\DTO;

class ProductFilterDTO
{
    public function __construct(
        public $name,
        public $min_price,
        public $max_price,
        public $description,
        public $available,
        public $category_id,
    )
    {}





}
