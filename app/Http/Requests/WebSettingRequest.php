<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WebSettingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'phone'     => 'required|string|max:20',
            'email'     => 'required|email|max:255',
            'instagram' => 'nullable|url|max:255',
            'linkedin'  => 'nullable|url|max:255',
            'facebook'  => 'nullable|url|max:255',
            'tiktok'    => 'nullable|url|max:255',
            'youtube'   => 'nullable|url|max:255',
        ];
    }
}
