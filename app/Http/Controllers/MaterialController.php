<?php

namespace App\Http\Controllers;

use App\Curso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Material;
use App\Http\Requests\MaterialRequest;


class MaterialController extends Controller
{
    /*Novo Material*/
    public function novo($curso)
    {
        $curso = Curso::find($curso);

        if($curso == null){
            return response(view('errors.404'), 404);
        }

        $material = new Material();
        $material->curso_id = $curso;

        //retornar a view passando as categorias
        return view('material.novo-material')->with('material', $material);
    }

    /*Editar Material*/
    public function editar($id)
    {
        $material = Material::find($id);

        if($material == null){
            return response(view('errors.404'), 404);
        }

        //retornar a view passando as categorias
        return view('material.editar-material')->with('material', $material);
    }


    /*Editar Material*/
    public function excluir($id)
    {
        $material = Material::find($id);

        if($material == null){
            return response(view('errors.404'), 404);
        }

        $material->delete();

        //retornar a view passando as categorias
        return redirect()->action('CursoController@detalhesAdmin', [$material->curso_id]);
    }


    /*Salvar um Material*/
    public function salvar( MaterialRequest $request)
    {

        //https://developer.mozilla.org/en/docs/Using_files_from_web_applications

        $curso_id = trim ($request->input('curso_id'));

        $arquivo = $request->file('arquivo')->getClientOriginalName();
        $path =config('app.upload_material').DIRECTORY_SEPARATOR.$curso_id.DIRECTORY_SEPARATOR.uniqid().DIRECTORY_SEPARATOR;

        $request->file('arquivo')->move($path, $arquivo);

        $material = new Material();
        //popular o model
        $material->titulo = $request->input('titulo');
        $material->descricao = $request->input('descricao');
        $material->curso_id = $curso_id ;
        $material->arquivo = $path.$arquivo;

        /*salvar o model*/
        $material->save();

        /*redirecionar para os detalhes do curso*/       
        return redirect()->action('CursoController@detalhesAdmin', [$material->curso_id]);

    }


    public function atualizar( MaterialRequest $request)
    {

        $material = Material::find($request->input('id'));

        $curso_id = trim($request->input('curso_id'));
        $arquivo =  $request->input('arquivo');

        //se está enviando um novo arquivo
        if($request->hasFile('novoarquivo')) {
            $arquivo = $request->file('novoarquivo')->getClientOriginalName();
            $path = config('app.upload_material') . DIRECTORY_SEPARATOR . $curso_id . DIRECTORY_SEPARATOR . uniqid() . DIRECTORY_SEPARATOR;
            $request->file('novoarquivo')->move($path, $arquivo);

            $arquivo = $path.$arquivo;
        }

        //popular o model
        $material->titulo = $request->input('titulo');
        $material->descricao = $request->input('descricao');
        $material->curso_id = $curso_id ;
        $material->arquivo = $arquivo;

        /*salvar o model*/
        $material->save();

        /*redirecionar para os detalhes do curso*/
        return redirect()->action('CursoController@detalhesAdmin', [$material->curso_id]);

    }

}
