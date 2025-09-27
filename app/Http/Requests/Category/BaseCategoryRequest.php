<?php

namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;

class BaseCategoryRequest extends FormRequest
{
   
    public function baseRules(): array
    {
        return [
            "name" => "required|string|unique:categories,name|min:3,max:80"
        ];
    }

    public function baseMessages(): array
    {
        return [
            "name.required" => "O nome da categoria é obrigatório",
            "name.string" => "O nome precisa ser uma palavra",
            "name.unique" => "A categoria já esta cadastrada",
            "name.min" => "Você precisa informar pelo menos 3 digitos no nome",
            "name.max" => "Você precisa informar no máximo 80 digitos no nome"
        ];
    }
}
