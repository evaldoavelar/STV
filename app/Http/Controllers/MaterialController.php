<?php

namespace App\Http\Controllers;

use App\Unidade;
use File;
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
    public function novo($unidade_id)
    {
        $unidade = Unidade::find($unidade_id);

        if (is_null( $unidade)) {
            return abort(404);
        }

        $material = new Material(['unidade_id' => $unidade_id]);

        //retornar a view passando o material
        return view('material.material-novo')->with('material', $material);
    }

    /*Editar Material*/
    public function editar($id)
    {
        $material = Material::find($id);

        if (is_null( $material)) {
            return abort(404);
        }

        //retornar a view passando as categorias
        return view('material.material-editar')->with('material', $material);
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
        return redirect()->action('CursoController@detalhesAdmin', [$material->unidade_id]);
    }


    /*Salvar um Material*/
    /*
     * Dar permissao no diretório
     * chown -R www-data:www-data /var/www/html/branches/STV/
     * chmod -R g+rw /var/www/html/branches/STV/
     * */
    public function salvar(MaterialRequest $request)
    {    //https://developer.mozilla.org/en/docs/Using_files_from_web_applications

        //verificar se já esxiste um material cadastrado com o mesmo títilo RN02
        if ($this->validaTitulo($request->input('titulo'), -1))
            return redirect()->back()->withErrors(['Título já usado por outro Material'])->withInput();

        $unidade_id = trim($request->input('unidade_id'));

        $arquivo = $request->file('arquivo')->getClientOriginalName();
        $path = DIRECTORY_SEPARATOR . $unidade_id . DIRECTORY_SEPARATOR . uniqid() . DIRECTORY_SEPARATOR;
        $fullPath = config('app.upload_material') . $path;

        File::makeDirectory($fullPath);
        $request->file('arquivo')->move($fullPath, $arquivo);

        $material = new Material();
        //popular o model
        $material->titulo = $request->input('titulo');
        $material->descricao = $request->input('descricao');
        $material->unidade_id = $unidade_id;
        $material->arquivo = $path . $arquivo;

        /*salvar o model*/
        $material->save();

        //recuperar a unidade do Material
        $unidade = Unidade::find($material->unidade_id );

        /*redirecionar para os detalhes do curso*/
        return redirect()->action('CursoController@detalhesAdmin', [$unidade->curso_id,$unidade->id] );

    }

    /*Atualizar um Material*/
    public function atualizar(MaterialRequest $request)
    {
        $material = Material::find($request->input('id'));

        //verificar se já esxiste um material cadastrado com o mesmo títilo RN02
        if ($this->validaTitulo($request->input('titulo'), $request->input('id')))
            return redirect()->back()->withErrors(['Título já usado por outro Material'])->withInput();

        $unidade_id = trim($request->input('unidade_id'));
        $arquivo = $request->input('arquivo');

        //se está enviando um novo arquivo, faz o upload
        if ($request->hasFile('novoarquivo')) {
            $arquivo = $request->file('novoarquivo')->getClientOriginalName();
            $path = DIRECTORY_SEPARATOR . $unidade_id . DIRECTORY_SEPARATOR . uniqid() . DIRECTORY_SEPARATOR;
            $fullPath = config('app.upload_material') . $path;

            $request->file('novoarquivo')->move($fullPath, $arquivo);

            $arquivo = $path . $arquivo;
        }

        //popular o model
        $material->titulo = $request->input('titulo');
        $material->descricao = $request->input('descricao');
      //  $material->unidade_id = $unidade_id;
        $material->arquivo = $arquivo;

        /*salvar o model*/
        $material->save();

        //recuperar a unidade do Material
        $unidade = Unidade::find($material->unidade_id );

        /*redirecionar para os detalhes do curso*/
        return redirect()->action('CursoController@detalhesAdmin', [$unidade->curso_id,$unidade->id] );

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
