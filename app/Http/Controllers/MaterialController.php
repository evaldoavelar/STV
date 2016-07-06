<?php

namespace App\Http\Controllers;

use App\Curso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Material;
use App\Http\Requests\MaterialRequest;


class MaterialController extends Controller
{

    /*Verificar Título duplicado RN02*/
    private function validaTitulo($titulo, $id)
    {
        $materialOld = Material::where('titulo', $titulo)->get();

        //verificar se o id do material existente é diferente do atual
        if ($materialOld->count() > 0 && $materialOld[0]->id != $id)
            return true;

        return false;
    }

    /*Verificar tamanho do arquivo RN-03*/
    private function validaTamArquivo($titulo, $id){

    }

    /*Novo Material*/
    public function novo($curso_id)
    {
        $curso = Curso::find($curso_id);

        if (is_null( $curso)) {
            return abort(404);
        }

        $material = new Material(['curso_id' => $curso_id]);

        //retornar a view passando o material
        return view('material.novo-material')->with('material', $material);
    }

    /*Editar Material*/
    public function editar($id)
    {
        $material = Material::find($id);

        if (is_null( $material)) {
            return abort(404);
        }

        //retornar a view passando as categorias
        return view('material.editar-material')->with('material', $material);
    }


    /*Excluir Material*/
    public function excluir($id)
    {
        $material = Material::find($id);

        if (is_null( $material)) {
            return abort(404);
        }

        $material->delete();

        //retornar a view passando as categorias
        return redirect()->action('CursoController@detalhesAdmin', [$material->curso_id]);
    }


    /*Salvar um Material*/
    public function salvar(MaterialRequest $request)
    {    //https://developer.mozilla.org/en/docs/Using_files_from_web_applications

        //verificar se já esxiste um material cadastrado com o mesmo títilo RN02
        if ($this->validaTitulo($request->input('titulo'), -1))
            return redirect()->back()->withErrors(['Título já usado por outro Material'])->withInput();

        $curso_id = trim($request->input('curso_id'));

        $arquivo = $request->file('arquivo')->getClientOriginalName();
        $path = DIRECTORY_SEPARATOR . $curso_id . DIRECTORY_SEPARATOR . uniqid() . DIRECTORY_SEPARATOR;
        $fullPath = config('app.upload_material') . $path;

        $request->file('arquivo')->move($fullPath, $arquivo);

        $material = new Material();
        //popular o model
        $material->titulo = $request->input('titulo');
        $material->descricao = $request->input('descricao');
        $material->curso_id = $curso_id;
        $material->arquivo = $path . $arquivo;

        /*salvar o model*/
        $material->save();

        /*redirecionar para os detalhes do curso*/
        return redirect()->action('CursoController@detalhesAdmin', [$material->curso_id]);

    }

    /*Atualizar um Material*/
    public function atualizar(MaterialRequest $request)
    {
        $material = Material::find($request->input('id'));

        //verificar se já esxiste um material cadastrado com o mesmo títilo RN02
        if ($this->validaTitulo($request->input('titulo'), $request->input('id')))
            return redirect()->back()->withErrors(['Título já usado por outro Material'])->withInput();

        $curso_id = trim($request->input('curso_id'));
        $arquivo = $request->input('arquivo');

        //se está enviando um novo arquivo, faz o upload
        if ($request->hasFile('novoarquivo')) {
            $arquivo = $request->file('novoarquivo')->getClientOriginalName();
            $path = DIRECTORY_SEPARATOR . $curso_id . DIRECTORY_SEPARATOR . uniqid() . DIRECTORY_SEPARATOR;
            $fullPath = config('app.upload_material') . $path;

            $request->file('novoarquivo')->move($fullPath, $arquivo);

            $arquivo = $path . $arquivo;
        }

        //popular o model
        $material->titulo = $request->input('titulo');
        $material->descricao = $request->input('descricao');
        $material->curso_id = $curso_id;
        $material->arquivo = $arquivo;

        /*salvar o model*/
        $material->save();

        /*redirecionar para os detalhes do curso*/
        return redirect()->action('CursoController@detalhesAdmin', [$material->curso_id]);

    }

    /*Download do arquivo do material*/
    public function download($id)
    {
        $material = Material::find($id);

        if (is_null( $material)) {
            return abort(404);
        }

        //path completo para o arquivo
        $arquivo = config('app.upload_material') . DIRECTORY_SEPARATOR . $material->arquivo;
        //extensão do arquivo
        $ext = pathinfo($arquivo, PATHINFO_EXTENSION);

        //montar a resposta http
        return response()->download($arquivo, basename($arquivo), ['Content-Type: ' . $ext]);
    }

}
