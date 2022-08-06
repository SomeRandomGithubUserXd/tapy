<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\Auth\AuthRequest;

class RegisterRequest extends AuthRequest
{
    public function rules(): array
    {
        return [
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', 'min:8'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
