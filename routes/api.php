<?php

use App\Http\Controllers\Auth\Login;
use App\Http\Controllers\Auth\Logout;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\ProductController as Product;
use \App\Http\Controllers\CategoryController as Category;
use \App\Http\Controllers\CartController as Cart;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/



Route::post('login', [Login::class, '__invoke']);
Route::post('logout', [Logout::class, '__invoke']);

Route::middleware(['auth:sanctum'])->group(function () {

    Route::prefix('/categories')->name('categories.')->group(function () {
        Route::post('/', [Category::class,'store'])->name('store');
        Route::delete('/{category}', [Category::class,'destroy'])->name('destroy');
    });


    Route::prefix('/products')->name('products.')->group(function () {
        Route::get('/{id}', [Product::class,'show'])->name('show');
        Route::get('/', [Product::class,'index'])->name('index');

        Route::middleware(['role:admin'])->group(function () {
            Route::post('/', [Product::class,'store'])->name('store');
            Route::put('/{id}', [Product::class,'update'])->name('update');
            Route::delete('/{id}', [Product::class,'destroy'])->name('destroy');
        });
    });

    Route::prefix('/cart')->name('cart.')->group(function () {
        Route::get('/view', [Cart::class,'index']);
        Route::post('/', [Cart::class,'store']);
        Route::delete('/', [Cart::class,'destroy']);
    });
});
