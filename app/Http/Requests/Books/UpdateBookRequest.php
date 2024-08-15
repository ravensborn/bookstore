<?php

namespace App\Http\Requests\Books;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBookRequest extends FormRequest
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
            'cover_image' => 'sometimes|required|image|mimes:jpg,png|max:' . (10 * 1024),
            'barcode' => 'sometimes|required|string|max:255',
            'name' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|required|string|max:4000',
            'category_id' => 'required|integer|exists:categories,id',
            'author' => 'sometimes|required|string|max:255',
            'translator' => 'sometimes|required|string|max:255',
            'publish_year' => 'required|integer',
            'cost' => 'sometimes|required|integer',
            'price' => 'sometimes|required|integer',
            'stock' => 'sometimes|required|integer',
        ];
    }
}
