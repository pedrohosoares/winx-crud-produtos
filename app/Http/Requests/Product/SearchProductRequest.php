<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class SearchProductRequest extends BaseProductRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        if(isset($this->order)){
            $this->merge([
                'order' => Str::upper($this->order),
            ]);
        }
        $this->basePrepareForValidation();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'id' => 'nullable|integer|min:1',
            'name' => 'nullable|string|max:140',
            'description' => 'nullable|string|max:500',
            'price' => 'nullable|numeric|min:0',
            'price_min' => 'nullable|numeric|min:0',
            'price_max' => 'nullable|numeric|min:0|gte:price_min',
            'stock' => 'nullable|integer|min:0',
            'category_id' => 'required|array|min:1',
            'category_id.*' => 'integer|distinct|exists:categories,id',
            'category_id.required' => 'Informe ao menos uma categoria',
            'category_id.array' => 'As categorias devem vir em formato de lista',
            'category_id.min' => 'Selecione pelo menos uma categoria',
            'category_id.*.integer' => 'Cada categoria deve ser um ID válido',
            'category_id.*.distinct' => 'Existem IDs de categoria repetidos',
            'category_id.*.exists' => 'Uma ou mais categorias não existem ou foram removidas',
            'deleted' => 'nullable|numeric',
            'page' => 'nullable|numeric',
            'limit' => 'nullable|numeric',
            'order' => 'nullable|string|in:ASC,DESC'
            //'deleted_start' => 'nullable|date|before_or_equal:deleted_end',
            //'deleted_end' => 'nullable|date|after_or_equal:deleted_start',
        ];
    }

    public function messages(): array
    {
        return [
            'id.integer' => 'Identificador de produto não encontrado',
            'name.string' => 'O nome do produto deve ser uma string',
            'description.string' => 'A descrição do produto deve ser uma string',
            'price.numeric' => 'O preço do produto deve ser um número',
            'price_min.numeric' => 'O preço do produto mínimo deve ser um número, podendo ser decimal',
            'price_max.numeric' => 'O preço do produto máximo deve ser um número, podendo ser decimal',
            'price_max.gte' => 'O preço máximo do produto deve ser maior ou igual ao preço mínimo',
            'stock.integer' => 'O estoquedo do produto deve ser um número inteiro',
            'category_id.exists' => 'A categoriado do produto informada não existe',
            'deleted.numeric' => 'A data de exclusão do produto deve ser um valor',
            'page.numeric' => 'A página deve ser um número inteiro',
            'limit.numeric' => 'O limite de registro deve ser um número',
            'order' => 'A ordem precisa ser ASC ou DESC'
            //'deleted_start.date' => 'A data de inicio deve ser uma data YYYY-mm-dd',
            //'deleted_start.end' => 'A data de fim deve ser uma data YYYY-mm-dd',
        ];
    }
}
