<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
    public function novo()
    {
        
        $unidade = new Unidade();
        $dados = array(           
            'unidade' => $unidade);

        //retornar a view passando as categorias
        return view('unidade/novo-unidade')->with($dados);
    }

    /*Salvar um Unidade*/
    public function salvar( UnidadeRequest $request)
    {
        $unidade = new Unidade();

        //popular o model
        $unidade->titulo = Input::get('titulo');
        $unidade->descricao = Input::get('descricao');
        $unidade->instrutor = Input::get('instrutor');
        $unidade->categoria_id = Input::get('categoria_id');
        $unidade->palavras_chaves = Input::get('palavras_chaves');

        /*salvar o model*/
        $unidade->save();

        /*redirecionar para os detalhes do Unidade*/
        return redirect()->action('CursoController@detalhesAdmin', [$unidade->curso_id]);
    }


    /*Salvar um unidade*/
    public function atualizar( UnidadeRequest $request)
    {
        $unidade = Unidade::find(Input::get('id'));

        if (is_null($unidade)) abort(404);

        //popular o model
        $unidade->titulo = Input::get('titulo');
        $unidade->descricao = Input::get('descricao');
        $unidade->instrutor = Input::get('instrutor');
        $unidade->categoria_id = Input::get('categoria_id');
        $unidade->palavras_chaves = Input::get('palavras_chaves');

        /*salvar o model*/
        $unidade->save();

        /*redirecionar para os detalhes do Unidade*/
        return redirect()->action('CursoController@detalhesAdmin', [$unidade->id]);
    }

    /*Editar o unidade */
    public function editar($id)
    {
        //recurperar o Unidade
        $unidade = Unidade::find($id);

        if (is_null($unidade)) abort(404);

        //recuperar as categorias do banco de dados
        $categorias = Categoria::all();


        $dados = array('unidade' => $unidade);

        //retornar a view 
        return view('unidade/unidade-editar')->with($dados);

    }

    /*Excluir o unidade */
    public function excluir($id)
    {
        //recurperar o unidade
        $unidade = Unidade::find($id);

        if (is_null($unidade)) abort(404);


        $unidade->delete();

        return redirect()->action('CursoController@listagem');

    }
}
