<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'customerName' => ['required', 'string', 'max:150'],
            'customerLastName' => ['required', 'string', 'max:150'],
            'customerEmail' => ['required', 'email'],
            'customerPhone' => ['required', 'string'],
            'customerAddress' => ['required', 'string'],
            'customerComment' => ['string'],
            'updateUser' => ['boolean'],
        ];
    }
}
