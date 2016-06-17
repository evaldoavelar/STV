<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Curso;
use App\Material;

use App\Http\Requests;

class MaterialController extends Controller
{
    /*Novo Material*/
    public function novo($curso)
    {       
        $material = new Material();
        $material->curso_id = $curso;

        //retornar a view passando as categorias
        return view('cursos/curso-cadastro-material')->with('material', $material);
    }


    /*Salvar um Material*/
    public function salvar( MaterialRequest $request)
    {

        $material = new Material();

        //verificar se o model está sendo inserido ou atualizado
        if (Input::get('id', 0) > 0) {
            //buscar pelo $id do model no banco de dados
            $material = Material::find(Input::get('id'));
        }

        //popular o model
        $material->titulo = Input::get('titulo');
        $material->descricao = Input::get('descricao');
        $material->curso_id = Input::get('curso_id');
        $material->arquivo = $request->file('arquivo');

        /*salvar o model*/
        $material->save();

        /*redirecionar para os detalhes do curso*/
        return redirect()->action('CursoController@detalhesAdmin', [$material->curso_id]);
    }
}
