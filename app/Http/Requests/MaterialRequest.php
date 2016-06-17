<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class MaterialRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'titulo' => 'required|max:200',
            'descricao' => 'required|max:200',
        ];
    }

    public function messages()
    {
        return [
            'required' => 'O campo :attribute não pode ser vazio.',
            'max' => 'O campo :attribute ultrapassa o tamanho máximo permitido.',
        ];
    }
}
