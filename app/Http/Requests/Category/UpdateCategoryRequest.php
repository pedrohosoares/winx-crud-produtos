<?php

namespace App\Http\Requests\Category;

use App\Http\Requests\Product\BaseProductRequest;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoryRequest extends BaseProductRequest
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
        $rules = $this->baseRules();
        $rules['id'] = 'required|exists|numeric';
        return $rules;
    }

    public function messages(): array
    {
        $message = $this->baseMessages();
        $message['id.required'] = "O ID precisa ser válido";
        $message['id.exists'] = "A categoria não existe";
        $message['id.numeric'] = "O ID precisa estar em caracteres válidos";
        return $message;
    }
}
