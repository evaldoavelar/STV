<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Requests\UnidadeRequest;
use App\Http\Requests;
use App\Unidade;

class UnidadeController extends Controller
{
    function __construct()
    {
        $this->middleware('autorizacaoAdmin');
    }

    /*Novo Unidade*/
    public function novo($curso_id)
    {        
        $unidade = new Unidade(['curso_id' =>$curso_id ]);
      
        //retornar a view passando as categorias
        return view('unidade/unidade-novo')->with( 'unidade' , $unidade);
    }

    /*Salvar um Unidade*/
    public function salvar( UnidadeRequest $request)
    {
        $unidade = new Unidade();

        //popular o model
        $unidade->descricao = Input::get('descricao');
        $unidade->curso_id = Input::get('curso_id');

        /*salvar o model*/
        $unidade->save();

        /*redirecionar para os detalhes do Unidade*/
        return redirect()->action('CursoController@detalhesAdmin', [$unidade->curso_id,$unidade->id] );
    }


    /*Salvar um unidade*/
    public function atualizar( UnidadeRequest $request)
    {
        $unidade = Unidade::find(Input::get('id'));

        if (is_null($unidade)) abort(404);

        //popular o model

        $unidade->descricao = Input::get('descricao');

        /*salvar o model*/
        $unidade->save();

        /*redirecionar para os detalhes do Unidade*/
        return redirect()->action('CursoController@detalhesAdmin', [$unidade->curso_id,$unidade->id] );
    }

    /*Editar o unidade */
    public function editar($id)
    {
        //recurperar o Unidade
        $unidade = Unidade::find($id);

        if (is_null($unidade)) abort(404);
        
        //retornar a view 
        return view('unidade/unidade-editar')->with('unidade' , $unidade);

    }

    /*Excluir o unidade */
    public function excluir($id)
    {
        //recurperar o unidade
        $unidade = Unidade::find($id);

        if (is_null($unidade)) abort(404);


        $unidade->delete();

        return redirect()->action('CursoController@detalhesAdmin', [$unidade->curso_id,0] );

    }
}
