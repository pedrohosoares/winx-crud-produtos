<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends BaseProductRequest
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
        $this->merge(['id' => $this->route('product')]);
        $this->merge(['meta' => $this->meta ?? []]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = $this->baseRules();
        $rules['id'] = 'required|numeric|exists:products,id';
        return $rules;
    }

    public function messages(): array
    {
        $message = $this->baseMessages();
        $message['id.required'] = 'O ID do produto é necessário';
        $message['id.exists'] = 'O produto não foi encontrado';
        $message['id.numeric'] = 'O ID precisa possuir caracteres válidos';
        return $message;
    }
}
