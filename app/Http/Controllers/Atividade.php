<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class Atividade extends Controller
{
    /**
     * @return string
     */
    public function novaResposta($valor)
    {
        return view('cursos/partial/atividade-resposta',array("valor" => $valor));
    }
}
