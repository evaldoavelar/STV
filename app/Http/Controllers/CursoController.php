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
        return view('cursos/curso-cadastro')->with($dados);
    }

    /*Salvar um curso*/
    public function salvar( CursoRequest $request)
    {

        $curso = new Curso();

        //verificar se o model está sendo inserido ou atualizado
        if (Input::get('id', 0) > 0) {
            //buscar pelo $id do model no banco de dados
            $curso = Curso::find(Input::get('id'));
        }

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

        //recuperar as categorias do banco de dados
        $categorias = Categoria::all();


        $dados = array(
            'categorias' => $categorias,
            'curso' => $curso);

        //retornar a view passando as categorias
        return view('cursos/curso-cadastro')->with($dados);

    }

    /*Exibir os detalhe do curso para o admin*/
    public function detalhesAdmin($id)
    {
        $curso = Curso::find($id);

        return view('cursos/curso-admin-detalhes')->with('curso', $curso);
    }

    public function listagem()
    {

        return view('cursos/curso-admin-detalhes');
    }
}
