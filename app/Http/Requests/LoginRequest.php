<?php

namespace App\Http\Requests;

use App\Dto\UserLoginDto;
use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:8'],
        ];
    }

    public function toDto(): UserLoginDto
    {
        return new UserLoginDto(
            email: $this->get('email'),
            password: $this->get('password'),
        );
    }
}
