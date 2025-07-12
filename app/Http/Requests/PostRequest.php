<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Sesuaikan jika pakai auth
    }

    public function rules(): array
    {
        return [
            'title'          => 'required|string|max:255',
            'date'           => 'required|date',
            'picture_upload' => 'nullable|image|max:2048',
            'picture_alt'    => 'nullable|string|max:255',
            'category_id'    => 'required|exists:categories,id',
            'slug'           => 'nullable|string|max:255|unique:posts,slug,' . $this->route('id'),
            'content'        => 'required|string',
            'status'         => 'required|in:draft,published',
            'tag'            => 'nullable|string|max:255',
            'keywords'       => 'nullable|string|max:255',
        ];
    }
}
