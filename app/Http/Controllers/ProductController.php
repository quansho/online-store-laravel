<?php

namespace App\Http\Controllers;

use App\Commands\Product\GetFilteredProductsQuery;
use App\Http\Requests\ProductIndexRequest;
use Illuminate\Support\Facades\Request;
use App\Commands\Product\CreateProductCommand;
use App\Commands\Product\DeleteProductCommand;
use App\Commands\Product\GetProductQuery;
use App\Commands\Product\UpdateProductCommand;
use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ProductResource;
use App\Mediators\ProductMediator;

class ProductController extends Controller
{
    public function __construct(
        protected ProductMediator $mediator
    )
    {}
    public function index(ProductIndexRequest $request): \Illuminate\Http\JsonResponse
    {
        $products = $this->mediator->dispatch(new GetFilteredProductsQuery($request->toDTO()));

        return response()->json($products);
    }

    public function store(CreateProductRequest $request): \Illuminate\Http\JsonResponse
    {
        $command = new CreateProductCommand($request->toDTO());

        $this->mediator->dispatch($command);

        return response()->json(['message' => 'Product created'], 201);
    }

    public function destroy($id): \Illuminate\Http\JsonResponse
    {
        $product = $this->mediator->dispatch(new GetProductQuery($id));
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        $this->mediator->dispatch(new DeleteProductCommand($product));

        return response()->json(['message' => 'Product deleted']);
    }

    public function update(UpdateProductRequest $request, $id): \Illuminate\Http\JsonResponse
    {
        $product = $this->mediator->dispatch(new GetProductQuery($id));
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        $command = new UpdateProductCommand($product, $request->toDTO());

        $this->mediator->dispatch($command);

        return response()->json(['message' => 'Product updated']);
    }

    public function show($id): \Illuminate\Http\JsonResponse
    {
        $product = $this->mediator->dispatch(new GetProductQuery($id));

        return response()->json(new ProductResource($product));
    }
}
