<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

/**
 * Class Login
 * @package App\Http\Controllers\Auth
 */
class Login extends Controller
{
    /**
     * @group Auth Endpoints
     * @param Request $request
     * @bodyParam email string required
     * @bodyParam password string required
     * @return JsonResponse
     * @throws ValidationException
     * @throws ValidationException
     */
    public function __invoke(Request $request): JsonResponse
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (!Auth::attempt($request->all())) {
            return response()->json([
                'message' => 'Error! User not found!',
            ], 401);
        }

        auth()->user()->tokens()->delete();

        $token = auth()->user()->createToken('api')->plainTextToken;
        $user = auth()->user();

        return response()->json((new UserResource($user))->setPlainTextToken($token, $request));
    }

}
