<?php

namespace App\Http\Requests\Pages;

use Illuminate\Foundation\Http\FormRequest;

class SettingsRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string'],
            'hide_logo' => ['required', 'boolean'],
            'link' => ['required', 'string'],
            'facebook_pixel_id' => ['nullable'],
            'google_analytics_tracking_id' => ['nullable'],
            'yandex_metrika_id' => ['nullable'],
            'tik_tok_pixel_id' => ['nullable'],
            'title' => ['nullable'],
            'description' => ['nullable'],
            'favicon' => ['nullable']
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
