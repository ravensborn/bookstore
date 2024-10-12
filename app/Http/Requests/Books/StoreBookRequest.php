<?php

namespace App\Http\Requests\Books;

use Illuminate\Foundation\Http\FormRequest;

class StoreBookRequest extends FormRequest
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
            'barcode' => 'required|string|unique:books,barcode|max:255',
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:4000',
            'category_id' => 'required|integer|exists:categories,id',
            'author' => 'required|string|max:255',
            'translator' => 'required|string|max:255',
            'publish_year' => 'required|integer',
            'cost' => 'required|integer',
            'price' => 'required|integer',
            'stock' => 'required|integer',
        ];
    }
}
