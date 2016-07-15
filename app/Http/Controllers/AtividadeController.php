<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\Facades\Auth;
use app\Http\Requests\AtividadeRequest;
use App\Unidade;
use App\Atividade;



use App\Http\Requests;

class AtividadeController extends Controller
{

    public function novo($unidade_id)
    {
        $unidade = Unidade::find($unidade_id);

        if (is_null( $unidade)) {
            return abort(404);
        }

        $atividade = new Atividade(['unidade_id' => $unidade_id]);

        //retornar a view passando o video
        return view('atividade.atividade-novo')->with('atividade', $atividade);
    }

    public function salvar(Request $request )
    {
        dd( $request->all());
        return view("teste");
    }

    public function novaResposta($valor)
    {

        return view("atividade/partial/atividade-resposta", ["valor" => $valor]);
    }
}
