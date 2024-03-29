<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth:api")->except('login');
    }

    public function login(Request $request): JsonResponse
    {
        $credentials = $request->validate([
            "email" => ['required', 'email'],
            "password" => ['required']
        ]);

        if (!$token = auth('api')->attempt($credentials)) {
            return response()->json([
                "error" => "Unauthorized"
            ], 401)->header('Content-Type', 'application/json');
        }

        return $this->token($token);
    }

    public function logout(): JsonResponse
    {
        auth('api')->logout();

        return response()->json([
            "message" => "Successfully logged out"
        ])->header('Content-Type', 'application/json');
    }

    public function user(): JsonResponse
    {
        return response()->json([
            "data" => new UserResource(auth()->user())
        ])->header('Content-Type', 'application/json');
    }

    public function refresh(): JsonResponse
    {
        return $this->token(auth()->refresh());
    }

    private function token($token): JsonResponse
    {
        $token_parts = explode('.', $token);
        return response()->json([
            "data" => [
                "token"      => $token,
                "type"       => 'bearer',
                "expires_in" => auth()->factory()->getTTL() * 60
            ]
        ])->header('Content-Type', 'application/json');
    }
}
