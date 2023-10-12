<?php

namespace App\Repositories;

use App\DTO\ProductFilterDTO;
use App\Models\Product;
use App\DTO\ProductDTO;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Log;

class EloquentProductRepository implements ProductRepositoryInterface
{
    public function create(ProductDTO $productDTO): Product
    {
        $product = new Product([
            'name' => $productDTO->name,
            'price' => $productDTO->price,
            'description' => $productDTO->description,
            'available' => $productDTO->available,
        ]);

        $product->save();

        if ($productDTO->image) {
            $product->addMedia($productDTO->image)->toMediaCollection('product_images');
        }

        if ($productDTO->category_id) {
            $product->categories()->sync($productDTO->category_id);
        }
        return $product;
    }

    public function update(Product $product, ProductDTO $productDTO): Product
    {
        $product->update([
            'name' => $productDTO->name,
            'price' => $productDTO->price,
            'description' => $productDTO->description,
            'available' => $productDTO->available,
        ]);

        return $product;
    }

    public function delete(Product $product): void
    {
        $product->delete();
    }

    public function find(int $productId): ?Product
    {
        return Product::find($productId);
    }

    public function getFilteredProducts(ProductFilterDTO $filters): ?Collection
    {
        $query = Product::query();

        if (isset($filters->name)) {
            $query->where('name',  'LIKE', "%$filters->name%");
        }

        if (isset($filters->category_id)) {
            $query->whereHas('categories', function ($q) use ($filters) {
                $q->where('id', $filters->category_id);
            });
        }

        if (isset($filters->min_price)) {
            $query->where('price', '>=', $filters->min_price);
        }

        if (isset($filter->max_price)) {
            $query->where('price', '<=', $filters->max_price);
        }

        if (isset($filters->description)) {
            $query->where('description','LIKE', "%$filters->description%");
        }

        if (isset($filters->available)) {
            $query->where('available', $filters->available);
        }


        return $query->get();
    }


}
