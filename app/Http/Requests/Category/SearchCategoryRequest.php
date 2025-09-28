<?php

namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class SearchCategoryRequest extends FormRequest
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
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'id' => "nullable|numeric|exists:categories,id",
            'name" => "nullable|string|max:80',
            'limit' => 'nullable|numeric',
            'page' => 'nullable|numeric',
            'order' => 'nullable|string|in:ASC,DESC'
        ];
    }

    public function messages(): array
    {
        return [
            'id.numeric' => 'O id da categoria precisa ser um número',
            'id.exists' => 'A categoria buscada não existe',
            'name.string' => 'O nome da categoria precisa ser uma string',
            'name.max' => 'O nome da categoria precisa ter até :max caracteres',
            'limit.numeric' => 'O limite precisa ser um número inteiro',
            'page.numeric' => 'A página precisa ser um número inteiro',
            'order' => 'A ordem precisa ser ASC ou DESC'
        ];
    }
}
