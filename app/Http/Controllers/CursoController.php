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
        $this->middleware('autorizacaoAdmin', ['except' => ['salvar', 'meusCursos', 'pesquisa', 'cursoPorCategoria', 'inscreverCurso', 'detalhesUsuario', 'avaliacao', 'certificado']]);

        //ligar os filtros para os metodos de  usuário
        $this->middleware('autorizacaoUsuarios')->only('meusCursos', 'inscreverCurso', 'avaliacao', 'certificado');
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


        try {


            $curso = new Curso();

            //popular o model
            $curso->titulo = Input::get('titulo');
            $curso->descricao = Input::get('descricao');
            $curso->instrutor = Input::get('instrutor');
            $curso->categoria_id = Input::get('categoria_id');
            $curso->palavras_chaves = Input::get('palavras_chaves');
            $curso->publicado = false;

            /*salvar o model*/
            $curso->save();


            //return response()->setStatusCode(200, 'The resource is created successfully!');
            /*redirecionar para os detalhes do curso*/
            return redirect()->action('CursoController@detalhesAdmin', [$curso->id, 0]);


        } catch (Exception $e) {
            Log::info('Erro ao salvar usuário: ' . $e->getMessage());

            return $e->getMessage();
        }
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

        $msg = "Curso salvo com sucesso!";

        //redirecionar com os parametros
        return redirect('curso-admin-detalhes/' . $curso->id . '/0?&msg=' . urlencode($msg));

        /*redirecionar para os detalhes do curso*/
        //  return redirect()->action('CursoController@detalhesAdmin', [$curso->id, 0]);
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

        $msg = "Curso excluido com sucesso!";
        $dados = \Illuminate\Support\Facades\Request::all();

        //redirecionar com os parametros
        return redirect('curso-lista?' . http_build_query($dados, '&') . '&msg=' . urlencode($msg));

        //  return redirect()->action('CursoController@listagem');

    }

    /*Exibir os detalhe do curso para o admin*/
    public function detalhesAdmin($id, $unidade = 0)
    {
        $curso = Curso::find($id);

        if (is_null($curso)) abort(404);

        $msg = \Illuminate\Support\Facades\Request::input('msg');

        return view('cursos/curso-admin-detalhes')->with([
            'curso' => $curso,
            'unidade_expande' => $unidade,
            'msg' => $msg,
        ]);
    }

    /*Listar todos os cursos Cadastrados*/
    public function lista(Request $request)
    {

        //Recuperar os parametros da requisição
        $data = $request->all();
        $msg = isset($data['msg']) ? $data['msg'] : null;

        //verifcar se está usando o filtro
        if (Util::checkIsNullAndEmpty($data, 'campo') && Util::checkIsNullAndEmpty($data, 'valor')) {
            //filtrar os usuários
            $cursos = Curso::where($data['campo'], "LIKE", $data['valor'] . '%')
                ->get();

            //retornar a consulta e os campos do filtro para a view
            return view('cursos/curso-listagem')->with(['cursos' => $cursos, 'valor' => $data['valor'], 'campo' => $data['campo'], 'msg' => $msg]);
            // dd(DB::getQueryLog());
        } else {
            $cursos = Curso::all();
            return view('cursos/curso-listagem')->with(['cursos' => $cursos, 'msg' => $msg]);
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

        if (!$curso->publicado)
            return response()->json(['inscrito' => false, 'msg' => 'Curso não publicado']);

        $user = User::find($user_id);
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

        $unidades = $curso->unidades()->get();

        if ($unidades->count() > 0) {
            //verificar se as unidades do curso tem uma atividade avaliativa
            foreach ($unidades as $unidade) {
                if ($unidade->atividades()->count() == 0) {
                    return view('cursos/curso-admin-detalhes')
                        ->with([
                            'curso' => $curso,
                            'unidade_expande' => 0,
                            'erro' => 'A unidade "' . $unidade->descricao . '" não contem uma atividade avaliativa. Cadastre ao menos uma atividade para publicar o curso.'
                        ]);
                }
            }
        } else {
            return view('cursos/curso-admin-detalhes')
                ->with([
                    'curso' => $curso,
                    'unidade_expande' => 0,
                    'erro' => 'Cadastre ao menos uma unidade para publicar o curso.'
                ]);
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

        if (Auth::check()) {
            $notas = $curso->RetornaNotaUsuarioCurso(Auth::user()->id);

            $aprovado = $curso->aprovado(Auth::user()->id);

            $videosAssistido = $curso->RetornaPorcentagemVideosAssistidos(Auth::user()->id);

        }else{

            $notas = array();
            $aprovado = false;
            $videosAssistido = 0;
        }

        return view('cursos/curso-usuario-detalhes')->with([
            'curso' => $curso,
            'notas' => $notas,
            'aprovado' => $aprovado,
            'videosAssistido' => $videosAssistido
        ]);
    }


    /*Listar os cursos do usuario logado*/
    public function meusCursos()
    {
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


    /*IGerar Certificado do curso*/
    public function certificado($curso_id)
    {
        $curso = Curso::find($curso_id);
        if (is_null($curso)) abort(404, 'Curso não encontrado');

        $aprovado = $curso->aprovado(Auth::user()->id);
        //  if(!$aprovado)
        //     abort(404, 'Usuário não aprovado');

        $user = User::find(Auth::user()->id);

        $inscrito = UserCurso::where('curso_id', $curso->id)
            ->where('user_id', Auth::user()->id)
            ->get()[0];

        $data = Util::formatDatePt_Br_ex(strtotime('today'));

        $dados = [
            'nome' => $user->name,
            'curso' => $curso->titulo,
            'data' => $data,
            'data_inscrito' => date('d/m/Y', strtotime($inscrito->created_at)),
        ];

        $pdf = SnappyPdf::loadView('cursos/curso-certificado', $dados);
        /* $pdf->setOption('margin-top',0);
         $pdf->setOption('margin-right',0);
         $pdf->setOption('margin-bottom',0);
         $pdf->setOption('margin-left',0);*/

        return $pdf->setPaper('a4')->setOrientation('landscape')->stream();
    }


    public function pesquisa(Request $request)
    {
        DB::enableQueryLog();

        $dados = $request->all();
        $valor = $dados['valor'];


        $cursos = Curso::where('palavras_chaves', 'like', $valor . '%')
            ->orWhere('titulo', 'like', $valor . '%')
            ->orWhere('descricao', 'like', $valor . '%')
            ->orWhere('instrutor', 'like', $valor . '%')
            ->where('publicado', '=', '1')
            ->get();


        //     dd(DB::getQueryLog());

        foreach ($cursos as $curso) {
            $curso->avaliacao = $curso->avaliacoes();
        }

        return view('cursos/pesquisa')->with(['cursos' => $cursos]);
    }
}
