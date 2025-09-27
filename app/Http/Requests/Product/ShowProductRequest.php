<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class ShowProductRequest extends FormRequest
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
            'id'=>'required|numeric|exists:products,id'
        ];
    }

    public function message(): array
    {
        return [
            'id.required'=>'Informe o ID do produto',
            'id.numeric'=>'Informe um ID válido',
            'id.exists'=>'Produto não encontrado'
        ];
    }
}
