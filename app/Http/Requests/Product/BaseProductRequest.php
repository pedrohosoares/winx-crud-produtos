<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

abstract class BaseProductRequest extends FormRequest
{

    public function basePrepareForValidation(): void
    {
        $category_id = explode(',',$this->category_id);
        $this->merge(['category_id'=>$category_id]);
    }

    public function baseRules(): array
    {

        $exists = Rule::exists('categories', 'id')->whereNull('deleted_at');

        return [
            'name' => 'required|string|min:3|max:140',
            'description' => 'nullable|string',
            'price' => 'required|numeric|decimal:0,9999999999.99|min:0|max:9999999999.99',
            'stock' => 'required|integer|min:0',
            'category_id' => 'required|array|min:1',
            'category_id.*' => 'integer|distinct|exists:categories,id',
            'meta' => 'nullable|array',
            'meta.*' => 'nullable|string',
        ];
    }

    public function baseMessages(): array
    {
        return [
            'name.required' => 'O campo nome é obrigatório',
            'name.string' => 'O campo nome deve ser um texto',
            'name.min' => 'O nome deve ter no mínimo :min caracteres',
            'name.max' => 'O nome deve ter no máximo :max caracteres',
            'description.string' => 'A descrição deve ser um texto',
            'price.required' => 'O preço é obrigatório',
            'price.numeric' => 'O preço deve ser um número',
            'price.decimal' => 'O preço deve ser um número com máximo de 10 dígitos e 2 casas decimais',
            'price.min' => 'O preço não pode ser negativo',
            'price.max' => 'O preço não pode ser maior que :max',
            'stock.required' => 'A quantidade em estoque é obrigatório',
            'stock.integer' => 'A quantidade do estoque deve ser um número',
            'stock.min' => 'O estoque não pode ser negativo',
            'category_id.required' => 'Informe ao menos uma categoria',
            'category_id.array' => 'As categorias devem vir em formato de lista',
            'category_id.min' => 'Selecione pelo menos uma categoria',
            'category_id.*.integer' => 'Cada categoria deve ser um ID válido',
            'category_id.*.distinct' => 'Existem IDs de categoria repetidos',
            'category_id.*.exists' => 'Uma ou mais categorias não existem ou foram removidas',
            'meta.array' => 'O campo meta deve ser um conjunto de dados'
        ];
    }
}