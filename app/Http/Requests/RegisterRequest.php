<?php

namespace App\Http\Requests;

use App\Dto\UserRegisterDto;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
        ];
    }

    public function toDto(): UserRegisterDto
    {
        return new UserRegisterDto(
            name: $this->get('name'),
            email: $this->get('email'),
            password: $this->get('password'),
        );
    }

}
