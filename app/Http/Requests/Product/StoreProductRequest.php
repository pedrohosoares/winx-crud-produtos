<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
            'name'        => 'required|string|min:3|max:140',
            'description' => 'nullable|string',
            'price'       => 'required|numeric|decimal:0,9999999999.99|min:0|max:9999999999.99',
            'stock'       => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'meta'        => 'nullable|array',
            'meta.*'      => 'nullable|string', 
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'O campo nome é obrigatório',
            'name.string'   => 'O campo nome deve ser um texto',
            'name.min'      => 'O nome deve ter no mínimo :min caracteres',
            'name.max'      => 'O nome deve ter no máximo :max caracteres',
            'description.string' => 'A descrição deve ser um texto',    
            'price.required' => 'O preço é obrigatório',
            'price.numeric'  => 'O preço deve ser um número',
            'price.decimal'  => 'O preço deve ser um número com máximo de 10 dígitos e 2 casas decimais',
            'price.min'      => 'O preço não pode ser negativo',
            'price.max'      => 'O preço não pode ser maior que :max',
            'stock.required' => 'A quantidade em estoque é obrigatório',
            'stock.integer'  => 'A quantidade do estoque deve ser um número',
            'stock.min'      => 'O estoque não pode ser negativo',
            'category_id.required' => 'A categoria é obrigatória',
            'category_id.exists'   => 'A categoria selecionada não existe',    
            'meta.array'      => 'O campo meta deve ser um conjunto de dados',
            'meta.*.string'   => 'Os campos meta devem ser um texto com o valor em texto, ex: "size":"33"',
        ];
    }
}
