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
            'image' => 'nullable|string',
            'short_description' => 'nullable|string|max:500',
            'description' => 'nullable|string|max:1500',
            'order_level' => 'required|integer',
			'status' => 'required'
        ];
    }

	protected $stopOnFirstFailure = true;
}
