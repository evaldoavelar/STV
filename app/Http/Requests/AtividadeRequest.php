<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class AtividadeRequest extends Request
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

    public function messages() {
        return [
            'questao.*.correta'=> 'A reposta correta não foi selecionada para a questão',
            'questao.*.enunciado.*'=> 'O enunciado da questão não foi informado',
            'questao.*.resposta.*'=> 'O enunciado da questão não foi informado',
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'titulo' => 'required|min:3|max:255',
            'descricao' => 'required|min:3|max:255',
            'questao.*.correta'=> 'required',
            'questao.*.enunciado.*'=> 'required',
            'questao.*.resposta.*'=> 'required',

        ];

        return $rules;
    }
}

