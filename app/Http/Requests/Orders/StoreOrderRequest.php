<?php

namespace App\Http\Requests\Orders;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
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
            'customer_name' => 'present_with:customer_phone_number|required_with:customer_phone_number|string|max:255',
            'customer_phone_number' => 'present_with:customer_name|required_with:customer_name|string|max:255',
            'total' => 'required|integer|gte:0',
            'paid' => 'required|integer|gte:0',
        ];
    }
}
