<?php

namespace App\Http\Controllers;

use App\Commands\Cart\AddToCart;
use App\Commands\Cart\RemoveFromCart;
use App\DTO\CartItemDTO;
use App\Handlers\GetUserCartQueryHandler;
use App\Commands\Product\DeleteProductCommand;
use App\Http\Requests\AddToCartRequest;
use App\Mediators\CartMediator;
use Illuminate\Support\Facades\Request;

class CartController extends Controller
{
    public function __construct(
        protected CartMediator $mediator
    )
    {}
    public function index(Request $request): \Illuminate\Http\JsonResponse
    {
        $products = $this->mediator->dispatch(new GetUserCartQueryHandler($request->user()));

        return response()->json($products);
    }

    public function store(AddToCartRequest $request): \Illuminate\Http\JsonResponse
    {
        $command = new AddToCart($request->toDTO());

        $this->mediator->dispatch($command);

        return response()->json(['message' => 'Cart created'], 201);
    }

    public function destroy($id): \Illuminate\Http\JsonResponse
    {
        $cartItem  = new CartItemDTO(auth()->user()->id,$id,0);
        $product = $this->mediator->dispatch(new RemoveFromCart($cartItem));
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        $this->mediator->dispatch(new DeleteProductCommand($product));

        return response()->json(['message' => 'Product deleted']);
    }


}
