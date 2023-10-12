<?php

namespace App\Commands\Cart;

use App\Models\User;

class GetCart
{
    public function __construct(public User $user)
    {}
}
