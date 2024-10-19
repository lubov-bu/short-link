<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Services\Auth\AuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Throwable;

class AuthController extends Controller
{
    public function __construct(
        private readonly AuthService $authService,
    ) {
    }

    public function register(RegisterRequest $request): JsonResponse
    {
        $user = $request->toDto();

        try {
            $this->authService->register($user);
        } catch (Throwable $t) {
            Log::error('[AuthController::register] ' . $t->getMessage() . ' trace: ' . $t->getTraceAsString());

            return response()->json(['message' => 'Возникла ошибка при регистрации'], 500);
        }

        return response()->json(['success' => true]);
    }

    public function login(LoginRequest $request): JsonResponse
    {
        $user = $request->toDto();

        try {
            $token = $this->authService->login($user);
        } catch (Throwable $t) {
            Log::error('[AuthController::login] ' . $t->getMessage() . ' trace: ' . $t->getTraceAsString());

            return response()->json(['message' => 'Возникла ошибка при входе'], 500);
        }

        return response()->json(['bearer' => $token]);
    }
}
