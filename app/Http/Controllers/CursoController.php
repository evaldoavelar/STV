<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use App\Categoria;
use App\Curso;
use Request;
use App\Http\Requests\CursoRequest;


use App\Http\Requests;

class CursoController extends Controller
{

    function __construct()
    {
        $this->middleware('autorizacaoUsuarios');
    }

    /*Novo Curso*/
    public function novo()
    {
        //recuperar as categorias do banco de dados
        $categorias = Categoria::all();
        $curso = new Curso();
        $dados = array(
            'categorias' => $categorias,
            'curso' => $curso);

        //retornar a view passando as categorias
        return view('cursos/curso-novo')->with($dados);
    }

    /*Salvar um curso*/
    public function salvar( CursoRequest $request)
    {
        $curso = new Curso();  

        //popular o model
        $curso->titulo = Input::get('titulo');
        $curso->descricao = Input::get('descricao');
        $curso->instrutor = Input::get('instrutor');
        $curso->categoria_id = Input::get('categoria_id');
        $curso->palavras_chaves = Input::get('palavras_chaves');

        /*salvar o model*/
        $curso->save();

        /*redirecionar para os detalhes do curso*/
        return redirect()->action('CursoController@detalhesAdmin', [$curso->id]);
    }


    /*Salvar um curso*/
    public function atualizar( CursoRequest $request)
    {       
        $curso = Curso::find(Input::get('id'));

        if (is_null($curso)) abort(404);

        //popular o model
        $curso->titulo = Input::get('titulo');
        $curso->descricao = Input::get('descricao');
        $curso->instrutor = Input::get('instrutor');
        $curso->categoria_id = Input::get('categoria_id');
        $curso->palavras_chaves = Input::get('palavras_chaves');

        /*salvar o model*/
        $curso->save();

        /*redirecionar para os detalhes do curso*/
        return redirect()->action('CursoController@detalhesAdmin', [$curso->id]);
    }

    /*Editar o curso */
    public function editar($id)
    {
        //recurperar o curso
        $curso = Curso::find($id);

        if (is_null($curso)) abort(404);

        //recuperar as categorias do banco de dados
        $categorias = Categoria::all();


        $dados = array(
            'categorias' => $categorias,
            'curso' => $curso);

        //retornar a view passando as categorias
        return view('cursos/curso-editar')->with($dados);

    }

    /*Excluir o curso */
    public function excluir($id)
    {
        //recurperar o curso
        $curso = Curso::find($id);

        if (is_null($curso)) abort(404);


        $curso->delete();
       
        return redirect()->action('CursoController@listagem');

    }

    /*Exibir os detalhe do curso para o admin*/
    public function detalhesAdmin($id)
    {
        $curso = Curso::find($id);

        if (is_null($curso)) abort(404);

        return view('cursos/curso-admin-detalhes')->with('curso', $curso);
    }

    /*Listar todos os cursos Cadastrados*/
    public function lista()
    {
        $cursos = Curso::orderBy('titulo','asc')->get();

        return view('cursos/curso-listagem')->with('cursos',$cursos);
    }
}
