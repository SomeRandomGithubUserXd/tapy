<?php

namespace App\Http\Requests\Pages\PageElements;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileElementRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'picture' => ['nullable'],
            'username' => ['nullable'],
            'caption' => ['nullable'],
            'position' => ['nullable'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
