<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use App\Categoria;
use App\Curso;
use App\Inscrito;
use App\Library\Util;
use Illuminate\Http\Request;
use App\Http\Requests\CursoRequest;


use App\Http\Requests;

class CursoController extends Controller
{

    function __construct()
    {
        //ligar os filtros para os metodos de administrador
        $this->middleware('autorizacaoAdmin', ['except' => ['meusCursos', 'cursoPorCategoria','inscreverCurso','detalhesUsuario']]);

        //ligar os filtros para os metodos de  usuário
        $this->middleware('autorizacaoUsuarios')->only('meusCursos');
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
    public function salvar(CursoRequest $request)
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
        return redirect()->action('CursoController@detalhesAdmin', [$curso->id, 0]);
    }


    /*Salvar um curso*/
    public function atualizar(CursoRequest $request)
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
        return redirect()->action('CursoController@detalhesAdmin', [$curso->id, 0]);
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
    public function detalhesAdmin($id, $unidade = 0)
    {
        $curso = Curso::find($id);

        if (is_null($curso)) abort(404);

        return view('cursos/curso-admin-detalhes')->with(['curso' => $curso, 'unidade_expande' => $unidade]);
    }

    /*Listar todos os cursos Cadastrados*/
    public function lista(Request $request)
    {

        //Recuperar os parametros da requisição
        $data = $request->all();

        //verifcar se está usando o filtro
        if (Util::checkIsNullAndEmpty($data, 'campo') && Util::checkIsNullAndEmpty($data, 'valor')) {
            //filtrar os usuários
            $usuarios = Curso::where($data['campo'], "LIKE", $data['valor'] . '%')->get();

            //retornar a consulta e os campos do filtro para a view
            return view('cursos/curso-listagem')->with(['cursos' => $usuarios, 'valor' => $data['valor'], 'campo' => $data['campo']]);
            // dd(DB::getQueryLog());
        } else {
            $cursos = Curso::orderBy('titulo', 'asc')->get();
            return view('cursos/curso-listagem')->with('cursos', $cursos);
        }

    }

    /*Listar todos os cursos por categorias*/
    public function cursoPorCategoria($categoria_id)
    {
        $categoria = Categoria::find($categoria_id);
        if (is_null($categoria)) abort(404, 'Categoria não encontrada');

        //filtrar os curso por categorias
        $cursos = Curso::where('categoria_id', $categoria_id)->get();

        //retornar a consulta para a view
        return view('cursos/cursos-por-categoria')->with(['cursos' => $cursos, 'categoria' => $categoria]);
    }

    /*Inscrever o usuário no curso*/
    public function inscreverCurso(Request $request)
    {
        $dados = $request->all();
        $curso_id = $dados['curso_id'];
        $user_id = $dados['user_id'];

        $curso = Curso::find($curso_id);
        if (is_null($curso)) abort(404, 'Curso não encontrado');

        $user = Curso::find($user_id);
        if (is_null($user)) abort(404, 'Usuario não encontrado');

        $inscrito = Curso::find($curso_id)->inscritos()->where('user_id',$user_id);

        if ($inscrito->get()->count() > 0)
            return response()->json(['inscrito' => false,'msg' => 'Usuário já inscrito no curso']);

        $inscrito = new Inscrito();
        $inscrito->curso_id = $curso_id;
        $inscrito->user_id = $user_id;
        $inscrito->save();

        return response()->json(['inscrito' => true]);
    }


    /*Detalhes do curso para o usuário*/
    public function detalhesUsuario($curso_id)
    {
        $curso = Curso::find($curso_id);
        if (is_null($curso)) abort(404, 'Curso não encontrado');

        return view('cursos/curso-usuario-detalhes')->with(['curso'=>$curso]);
    }

    public function meusCursos()
    {
        return view('cursos/meus-cursos');
    }

}
