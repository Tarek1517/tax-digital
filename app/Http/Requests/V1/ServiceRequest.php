<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;

class ServiceRequest extends FormRequest
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
            'title' => 'nullable|string|max:255',
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string',
            'service_category_id' => 'required|integer|exists:service_categories,id',
            'image' => $this->isMethod('post')
                ? 'nullable|mimes:png,jpg,jpeg,webp,avif|max:2048'
                : 'sometimes|nullable|mimes:png,jpg,jpeg,webp,avif|max:2048',
            'icon' => 'nullable|string|max:1000',
            'short_description' => 'nullable|string',
            'description' => 'nullable|string',
            'order_level' => 'required|integer',
            'status' => 'required'
        ];
    }

    protected $stopOnFirstFailure = true;
}
