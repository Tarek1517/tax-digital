<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
            'package_id' => 'required',
            'user_id' => 'required',
            'cus_email' => 'required|email',
            'companey_name' => 'required|string',
            'cus_name' => 'required',
            'cus_phone' => 'required',
            'total_payment' => 'required|numeric',
            'payment_method' => 'required|string',
            'package_name' => 'required|string',
        ];
    }

    protected $stopOnFirstFailure = true;

}
