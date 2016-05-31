<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class AtividadeController extends Controller
{

    public function salvar(Requests\AtividadeRequest $request)
    {
        echo ("<pre>" + $request::all()) + "</pre>";
        return view("teste");
    }

    public function novaResposta($valor)
    {

        return view("cursos/partial/atividade-resposta", ["valor" => $valor]);
    }
}
