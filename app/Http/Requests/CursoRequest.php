<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CursoRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        /*
         * Ele é executado antes mesmo da validação, portanto se o deixarmos como false,
         * ninguém vai conseguir adicionar produtos. Normalmente nesse método podemos verificar se o
         * usuário tem permissões, fazer consultas no banco
         * de dados etc   */
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'titulo' => 'required|max:200',
            'descricao' => 'required|max:200',
            'instrutor' => 'required|max:200',
            'categoria_id' => 'required|numeric',
            'palavras_chaves' => 'required|max:200'
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
