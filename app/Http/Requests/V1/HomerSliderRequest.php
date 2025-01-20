<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;

class HomerSliderRequest extends FormRequest
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
            'title' => 'required|string',
            'sub_title' => 'required|string',
            'button_link' => 'required|string',
            'image' => $this->isMethod('post')
                ? 'nullable|mimes:png,jpg,jpeg,webp,avif|max:2048'
                : 'sometimes|nullable|mimes:png,jpg,jpeg,webp,avif|max:2048',
            'order_level' => 'nullable|string|max:1000',
            'short_description' => 'nullable|string',
            'status' => 'required'
        ];
    }

    protected $stopOnFirstFailure = true;
}
