<?php

namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoryRequest extends FormRequest
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
        $this->merge(['id' => $this->route('category')]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "id" => "required|exists:categories,id|numeric",
            "name" => "required|string|min:3,max:80"
        ];
    }

    public function messages(): array
    {
        return [
            "id.required" => "O ID precisa ser válido",
            "id.exists" => "A categoria não existe",
            "id.numeric" => "O ID precisa estar em caracteres válidos",
            "name.required" => "O nome da categoria é obrigatório",
            "name.string" => "O nome precisa ser uma palavra",
            "name.min" => "Você precisa informar pelo menos 3 digitos no nome",
            "name.max" => "Você precisa informar no máximo 80 digitos no nome"
        ];
    }
}
