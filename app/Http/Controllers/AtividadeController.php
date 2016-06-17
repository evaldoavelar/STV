<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\Facades\Auth;
use app\Http\Requests\AtividadeRequest;

use App\Http\Requests;

class AtividadeController extends Controller
{

    public function salvar( )
    {
        echo ("<pre>" + Request::all() + "</pre>");
        return view("teste");
    }

    public function novaResposta($valor)
    {

        return view("cursos/partial/atividade-resposta", ["valor" => $valor]);
    }
}
