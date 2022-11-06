<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class AuthRequest extends FormRequest
{
    public function messages()
    {
        return [
            'email.required' => 'Please, input your email',
            'password.required' => 'Please, input your password',
            'email.email' => 'This value is not a valid email address.',
            'email.unique' => 'This email already registered',
            'password.min' => 'This value is too short. It should have :min characters or more.',
        ];
    }
}
