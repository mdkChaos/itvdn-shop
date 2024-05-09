<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ProductFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|min:3|max:255',
            'slug' => 'string',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'barcode' => 'required|string',
            'stock' => 'required|integer',
            'cover' => 'required|string',
            'categories' => 'required|array',
            'categories.*' => 'string',
        ];
    }
}
