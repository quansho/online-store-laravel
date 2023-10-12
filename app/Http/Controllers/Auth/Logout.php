<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

/**
 * Class Logout
 * @group Auth Endpoints
 * @authenticated
 * @package App\Http\Controllers\Auth
 */
class Logout extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    /**
     * @return JsonResponse
     */
    public function __invoke(): JsonResponse
    {
        auth()->user()->tokens()->delete();
        return response()->json('Tokens Revoked', 200);
    }
}
