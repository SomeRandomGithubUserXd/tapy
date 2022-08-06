<?php

namespace App\Http\Requests\Products;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'photos' => ['required', 'array'],
            'name' => ['required', 'string'],
            'description' => ['nullable', 'string'],
            'price' => ['nullable', 'int'],
            'currency' => ['required', 'exists:currencies,short_name', 'string'],
            'old_price' => ['nullable', 'int'],
            'action_btn' => ['nullable', 'boolean'],
            'btn_label' => ['required_if:action_btn,true', 'nullable', 'string'],
            'btn_link' => ['required_if:action_btn,true', 'nullable', 'string'],
        ];
    }

    public function messages()
    {
        return [
            'photos.required' => 'Please upload product photos',
            'name.required' => 'Please input product name',
            'btn_link.required_if' => 'Please input link'
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
