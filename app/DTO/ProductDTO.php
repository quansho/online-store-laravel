<?php

namespace App\DTO;

class ProductDTO
{
    public function __construct(
        public string $name,
        public float $price,
        public string $description,
        public bool $available,
        public $image=null,
        public $category_id=null,
    )
    {}





}
