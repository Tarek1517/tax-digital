<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;

class PackageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'price' => 'required|numeric',
            'slug' => 'nullable|string',
            'image' => 'nullable|image|mimes:png,jpg,jpeg,webp,avif|max:2048',
            'description' => 'nullable|string|max:255',
            'order_level' => 'required|integer',
            'status' => 'required',
        ];
    }
}
