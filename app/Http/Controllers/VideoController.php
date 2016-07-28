<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use App\Unidade;
use App\Video;
use App\Http\Requests\VideoRequest;

class VideoController extends Controller
{

    function __construct()
    {
        //ligar os filtros para os metodos de administrador
        $this->middleware('autorizacaoAdmin', ['except' => ['detalhe']]);

        //ligar os filtros para os metodos de  usuário
        $this->middleware('autorizacaoUsuarios')->only('detalhe');
    }


    /*Verificar Título duplicado RN02*/
    private function validaTitulo($titulo, $id)
    {
        $videoOld = Video::where('titulo', $titulo)->get();

        //verificar se o id do Video existente é diferente do atual
        if ($videoOld->count() > 0 && $videoOld[0]->id != $id)
            return true;

        return false;
    }


    /*Novo video*/
    public function novo($unidade_id)
    {
        $unidade = Unidade::find($unidade_id);

        if (is_null( $unidade)) {
            return abort(404);
        }

        $video = new Video(['unidade_id' => $unidade_id]);        

        //retornar a view passando o video
        return view('video.video-novo')->with('video', $video);
    }

    /*Editar Video*/
    public function editar($id)
    {
        $video = Video::find($id);

        if (is_null( $video)) {
            return abort(404);
        }

        //retornar a view passando as categorias
        return view('video.video-editar')->with('video', $video);
    }


    /*Excluir Video*/
    public function excluir($id)
    {
        $video = Video::find($id);

        if (is_null( $video)) {
            return abort(404);
        }

        $video->delete();

        //recuperar a unidade do video
        $unidade = Unidade::find($video->unidade_id );

        /*redirecionar para os detalhes do curso*/
        return redirect()->action('CursoController@detalhesAdmin', [$unidade->curso_id,$unidade->id] );


    }


    /*Salvar um Video*/
    public function salvar(VideoRequest $request)
    {    //https://developer.mozilla.org/en/docs/Using_files_from_web_applications

        //verificar se já esxiste um Video cadastrado com o mesmo títilo RN02
        if ($this->validaTitulo($request->input('titulo'), -1))
            return redirect()->back()->withErrors(['Título já usado por outro Video'])->withInput();

        $video = new Video();
        //popular o model
        $video->titulo = $request->input('titulo');
        $video->descricao = $request->input('descricao');
        $video->unidade_id = trim($request->input('unidade_id'));;
        $video->url = $request->input('url');

        /*salvar o model*/
        $video->save();

            //recuperar a unidade do video
        $unidade = Unidade::find($video->unidade_id );

        /*redirecionar para os detalhes do curso*/
        return redirect()->action('CursoController@detalhesAdmin', [$unidade->curso_id,$unidade->id] );
    }

    /*Atualizar um Video*/
    public function atualizar(VideoRequest $request)
    {
        $video = Video::find($request->input('id'));

        //verificar se já esxiste um Video cadastrado com o mesmo títilo RN02
        if ($this->validaTitulo($request->input('titulo'), $request->input('id')))
            return redirect()->back()->withErrors(['Título já usado por outro Video'])->withInput();

        $video->titulo = $request->input('titulo');
        $video->descricao = $request->input('descricao');
        $video->unidade_id = trim($request->input('unidade_id'));;
        $video->url = $request->input('url');

        /*salvar o model*/
        $video->save();

        //recuperar a unidade do video
        $unidade = Unidade::find($video->unidade_id );

        /*redirecionar para os detalhes do curso*/
        return redirect()->action('CursoController@detalhesAdmin', [$unidade->curso_id,$unidade->id] );

    }

    /*detalhe do video */
    public function detalhe($id)
    {
        //recurperar o Video
        $video = Video::find($id);

        if (is_null( $video)) {
            return abort(404);
        }

        //retornar a view 
        return view('video/video-detalhe')->with('video' , $video);

    }
}
