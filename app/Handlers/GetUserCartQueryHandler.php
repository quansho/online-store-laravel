<?php

namespace App\Handlers;

use App\Commands\Cart\GetCart;
use App\Models\Cart;

class GetUserCartQueryHandler
{
    public function handle(GetCart $query):  \Illuminate\Database\Eloquent\Collection|array
    {
        return Cart::with('product')->where('user_id', $query->user->id)->get();
    }
}
