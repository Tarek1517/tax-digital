<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;

class ServiceCategoryRequest extends FormRequest
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
            'name' => $this->isMethod('POST') ? 'required|string|unique:service_categories,name|max:255' : 'required|string|max:255',
            'title' => 'nullable|string|max:255',
            'slug' => 'nullable|string',
            'icon' => 'nullable|string|max:1000',
            'image' => $this->isMethod('post')
                ? 'nullable|mimes:png,jpg,jpeg,webp,avif|max:2048'
                : 'sometimes|nullable|mimes:png,jpg,jpeg,webp,avif|max:2048',
            'short_description' => 'nullable|string',
            'description' => 'nullable|string',
            'order_level' => 'nullable',
            'status' => 'required'
        ];
    }
}
