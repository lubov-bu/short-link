<?php

namespace App\Services\Auth;

use App\Dto\UserLoginDto;
use App\Dto\UserRegisterDto;
use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    public function register(UserRegisterDto $user): User
    {
        return User::query()->create([
            'name' => $user->getName(),
            'email' => $user->getEmail(),
            'password' => Hash::make($user->getPassword()),
        ]);
    }

    public function login(UserLoginDto $user): JsonResponse
    {
        $dbUser = User::query()->where('email', $user->getEmail())->first();

        if (!$dbUser || !Hash::check($user->getPassword(), $dbUser->password)) {
            throw new Exception('Неверный логин или пароль');
        }

        return response()->json(['bearer' => $dbUser->createToken('auth_token')->plainTextToken]);
    }
}
