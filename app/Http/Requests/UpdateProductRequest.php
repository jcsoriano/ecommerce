<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'photo' => 'sometimes|image|max:10240',
            'name' => 'required|string|max:255',
            'content' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock_level' => 'required|integer|min:0',
        ];
    }
}
