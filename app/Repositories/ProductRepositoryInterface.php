<?php

namespace App\Repositories;

use App\DTO\ProductDTO;
use App\DTO\ProductFilterDTO;
use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

interface ProductRepositoryInterface
{
    /**
     * Create product
     *
     * @param ProductDTO $productDTO
     * @return Product
     */
    public function create(ProductDTO $productDTO): Product;

    /**
     * Update exist product
     *
     * @param Product $product
     * @param ProductDTO $productDTO
     * @return Product
     */
    public function update(Product $product, ProductDTO $productDTO): Product;

    /**
     * Delete product
     *
     * @param Product $product
     * @return void
     */
    public function delete(Product $product): void;

    /**
     * Find by id
     *
     * @param int $productId
     * @return Product|null
     */
    public function find(int $productId): ?Product;

    /**
     * Find by id
     *
     * @param ProductFilterDTO $filters
     * @return Collection|null
     */
    public function getFilteredProducts(ProductFilterDTO $filters): ?Collection;


}
