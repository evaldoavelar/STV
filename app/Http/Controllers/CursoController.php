<?php

namespace App\Http\Controllers;

use App\UserCurso;
use Illuminate\Support\Facades\Input;
use App\Categoria;
use App\Curso;
use App\Inscrito;
use App\User;
use App\CursoAvaliacao;
use Auth;
use App\Library\Util;
use Illuminate\Http\Request;
use App\Http\Requests\CursoRequest;
use DB;
use App;
use Barryvdh\Snappy\Facades\SnappyPdf;


use App\Http\Requests;

class CursoController extends Controller
{

    function __construct()
    {
        //ligar os filtros para os metodos de administrador
        $this->middleware('autorizacaoAdmin', ['except' => ['meusCursos', 'cursoPorCategoria', 'inscreverCurso', 'detalhesUsuario', 'avaliacao']]);

        //ligar os filtros para os metodos de  usuário
        $this->middleware('autorizacaoUsuarios')->only('meusCursos', 'inscreverCurso', 'detalhesUsuario', 'avaliacao');
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
            $usuarios = Curso::where($data['campo'], "LIKE", $data['valor'] . '%')
                ->get();

            //retornar a consulta e os campos do filtro para a view
            return view('cursos/curso-listagem')->with(['cursos' => $usuarios, 'valor' => $data['valor'], 'campo' => $data['campo']]);
            // dd(DB::getQueryLog());
        } else {
            return view('cursos/curso-listagem')->with('cursos', []);
        }

    }

    /*Listar todos os cursos por categorias*/
    public function cursoPorCategoria($categoria_id)
    {
        $categoria = Categoria::find($categoria_id);
        if (is_null($categoria)) abort(404, 'Categoria não encontrada');

        //filtrar os curso por categorias
        $cursos = Curso::where('categoria_id', $categoria_id)
            ->where('publicado', '=', '1')
            ->get();

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

        $inscrito = Curso::find($curso_id)->inscritos()->where('user_id', $user_id);

        if ($inscrito->get()->count() > 0)
            return response()->json(['inscrito' => false, 'msg' => 'Usuário já inscrito no curso']);

        $inscrito = new UserCurso();
        $inscrito->curso_id = $curso_id;
        $inscrito->user_id = $user_id;
        $inscrito->save();

        return response()->json(['inscrito' => true]);
    }

    /*Publicar o curso*/
    public function publicar($curso_id)
    {
        $curso = Curso::find($curso_id);
        if (is_null($curso)) abort(404, 'Curso não encontrado');

        //verificar se as unidades do curso tem uma atividade avaliativa
        foreach ($curso->unidades()->get() as $unidade) {
            if ($unidade->atividades()->count() == 0) {
                return view('cursos/curso-admin-detalhes')
                    ->with([
                        'curso' => $curso,
                        'unidade_expande' => 0,
                        'erro' => 'A unidade "'.$unidade->descricao.'" não contem uma atividade avaliativa. Cadastre ao menos uma atividade para publicar o curso.'
                    ]);
            }
        }

        $curso->publicado = true;
        $curso->save();

        return view('cursos/curso-admin-detalhes')
            ->with([
                'curso' => $curso,
                'unidade_expande' => 0,
                'msg' => 'Curso publicado com sucesso!'
            ]);
    }

    /*Publicar o curso*/
    public function despublicar($curso_id)
    {
        $curso = Curso::find($curso_id);
        if (is_null($curso)) abort(404, 'Curso não encontrado');

        $curso->publicado = false;
        $curso->save();

        return view('cursos/curso-admin-detalhes')
            ->with([
                'curso' => $curso,
                'unidade_expande' => 0,
                'msg' => 'Curso despublicado com sucesso!'
            ]);;
    }

    /*Detalhes do curso para o usuário*/
    public function detalhesUsuario($curso_id)
    {
        $curso = Curso::find($curso_id);
        if (is_null($curso)) abort(404, 'Curso não encontrado');

        $notas = $curso->RetornaNotaUsuarioCurso(Auth::user()->id);

        $aprovado = true;

        foreach ($notas as $nota) {
            if ($nota->nota < 60) {
                $aprovado = false;
                break;
            }
        }

        return view('cursos/curso-usuario-detalhes')->with(['curso' => $curso, 'notas' => $notas, 'aprovado' => $aprovado]);
    }


    /*Listar os cursos do usuario logado*/
    public function meusCursos()
    {

        $pdf = SnappyPdf::loadView('welcome');
        return $pdf->setPaper('a4')->setOrientation('landscape')->setOption('margin-bottom', 0)->stream('welcome.pdf');

        $user = User::find(Auth::user()->id);

        //   DB::enableQueryLog();
        $cursos = $user->cursos()->get();


        foreach ($cursos as $curso) {
            $curso->avaliacao = $curso->avaliacoes();
        }

        //  dd(DB::getQueryLog());

        $inscrito = $user->cursos()->count();

        return view('cursos/meus-cursos')->with(['cursos' => $cursos, 'inscrito' => $inscrito]);
    }

    /*Avaliar um curso */
    public function avaliacao($curso_id, $avaliacao)
    {
        $curso = Curso::find($curso_id);
        $avaliado = CursoAvaliacao::where('user_id', '=', Auth::user()->id)
            ->where('curso_id', '=', $curso_id)
            ->get();

        if ($avaliado->count() == 0) {
            $avaliado = new CursoAvaliacao();
            $avaliado->curso_id = $curso_id;
            $avaliado->user_id = Auth::user()->id;
            $avaliado->avaliacao = $avaliacao;
            $avaliado->save();

        } else {
            $avaliado[0]->avaliacao = $avaliacao;
            $avaliado[0]->save();
        }

        $curso = Curso::find($curso_id);
        if (is_null($curso)) abort(404, 'Curso não encontrado');


        return redirect()->action('CursoController@detalhesUsuario', [$curso_id]);

        // return view('cursos/curso-usuario-detalhes')->with(['curso'=>$curso,'msg'=>"Curso Avaliado com Sucesso!"]);

    }
}
