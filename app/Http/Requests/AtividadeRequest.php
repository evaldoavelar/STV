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
            'required' => 'O Campo :attribute é obrigatório',
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [

            'titulo' => 'required|min:3|max:255',
            'descricao' => 'required|min:3|max:255',
        ];
    }
}
