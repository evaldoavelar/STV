<?php

namespace App\Http\Controllers;


use App\UserAtividade;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AtividadeRequest;
use App\Unidade;
use App\Atividade;
use App\Questao;
use App\Resposta;
use App\UserQuestao;


use App\Http\Requests;
use Mockery\CountValidator\Exception;

class AtividadeController extends Controller
{


    function __construct()
    {
        //ligar os filtros para os metodos de administrador
        $this->middleware('autorizacaoAdmin', ['except' => ['realizarAtividade', 'detalhe']]);

        //ligar os filtros para os metodos de  usuário
        $this->middleware('autorizacaoUsuarios')->only('realizarAtividade', 'detalhe');
    }

    public function novo($unidade_id)
    {
        $unidade = Unidade::find($unidade_id);

        if (is_null($unidade)) {
            return abort(404);
        }

        $atividade = new Atividade(['unidade_id' => $unidade_id]);

        //retornar a view passando o video
        return view('atividade.atividade-novo')->with('atividade', $atividade);
    }


    /*
     * Salvar a atividade
     * */
    public function salvar(Request $request)
    {
        $dados = ($request->all());

      //  if(count($dados['questao'] < 2))
        //    return redirect()->back()->withErrors(['A atividade deve ter ao menos duas questões']);

        // dd($dados);
        try {

            DB::beginTransaction();

            //criar a atividade
            $atividade = new Atividade();
            $atividade->titulo = trim($dados['titulo']);
            $atividade->descricao = trim($dados['descricao']);
            $atividade->unidade_id = trim($dados['unidade_id']);
            $atividade->save();


            //pecorrer as questões
            foreach ($dados['questao'] as $i => $q) {

                //criar a questão
                $questao = new Questao();
                $questao->enunciado = ($q['enunciado']);
                $questao->atividade_id = $atividade->id;
                $questao->save();

                //pecorrer as respostas
                foreach ($q['resposta'] as $j => $rd) {

                    //criar as respostas
                    $resposta = new Resposta();
                    $resposta->questao_id = $questao->id;
                    $resposta->enunciado = ($rd['enunciado']);
                    $resposta->correta = isset($q['correta']) && ($q['correta'] == $j);
                    $resposta->save();
                }
            }

            DB::commit();

        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['msg', 'Não foi possível Salvar as questões!!! Contate o suporte.']);
        }

        //recuperar a unidade do Material
        $unidade = Unidade::find($atividade->unidade_id);

        /*redirecionar para os detalhes do curso*/
        return redirect()->action('CursoController@detalhesAdmin', [$unidade->curso_id, $unidade->id]);
    }


    /*
     * Atualizar a atividade
     * */
    public function atualizar(Request $request)
    {
        $dados = ($request->all());

        // dd($dados);
        try {

            DB::beginTransaction();

            //criar a atividade
            $atividade = Atividade::find($dados['id']);

            if (is_null($atividade)) {
                return abort(404, "Unidade não localizada");
            }

            $atividade->titulo = trim($dados['titulo']);
            $atividade->descricao = trim($dados['descricao']);
            $atividade->save();


            //pecorrer as questões
            foreach ($dados['questao'] as $i => $q) {

                $questao = null;

                switch ($q['status']) {
                    case 'N': { //novo
                        $questao = new Questao();
                        $questao->atividade_id = $atividade->id;
                        $questao->enunciado = trim($q['enunciado']);
                        $questao->save();
                        break;
                    }
                    case 'E': //edição
                        $questao = Questao::find($i);
                        $questao->enunciado = trim($q['enunciado']);
                        $questao->save();
                        break;
                    case 'X': { // exclusão
                        $questao = Questao::find($i);
                        if (is_null($questao)) {
                            return abort(404, "Questao não localizada");
                        }
                        $questao->delete();
                        break;
                    }

                    default:
                        return abort(404, "Questao não localizada");
                }

                //a questão foi excluida, não precisa pecorre  as respostas
                if ($q['status'] != 'X') {

                    //pecorrer as respostas
                    foreach ($q['resposta'] as $j => $rd) {

                        //criar as respostas

                        switch ($rd['status']) {
                            case 'N': { //nova
                                $resposta = new Resposta();
                                $resposta->questao_id = $questao->id;
                                $resposta->enunciado = trim($rd['enunciado']);
                                $resposta->correta = isset($q['correta']) && ($q['correta'] == $j);
                                $resposta->save();
                                break;
                            }
                            case 'E': //edição
                                $resposta = Resposta::find($j);
                                $resposta->enunciado = trim($rd['enunciado']);
                                $resposta->correta = isset($q['correta']) && ($q['correta'] == $j);
                                $resposta->save();
                                break;
                            case 'X': { //exclusão
                                $resposta = Resposta::find($j);
                                if (!is_null($resposta)) {
                                    $resposta->delete();
                                }
                                break;
                            }
                        }
                    }
                }
            }

            DB::commit();

        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['msg', 'Não foi possível Salvar as questões!!! Contate o suporte.']);
        }

        //recuperar a unidade do Material
        $unidade = Unidade::find($atividade->unidade_id);

        /*redirecionar para os detalhes do curso*/
        return redirect()->action('CursoController@detalhesAdmin', [$unidade->curso_id, $unidade->id]);
    }

    /*
       * Editar a atividade
       * */
    public function excluir($id)
    {
        $atividade = Atividade::find($id);

        if (is_null($atividade)) {
            return abort(404, "Atividade não encontrada");
        }

        //recuperar a unidade do Material
        $unidade = Unidade::find($atividade->unidade_id);


        $atividade->delete();

        /*redirecionar para os detalhes do curso*/
        return redirect()->action('CursoController@detalhesAdmin', [$unidade->curso_id, $unidade->id]);
    }

    /*
      * Editar a atividade
      * */
    public function editar($id)
    {
        $atividade = Atividade::find($id);

        if (is_null($atividade)) {
            return abort(404);
        }

        //retornar a view passando a atividade
        return view('atividade.atividade-editar')->with('atividade', $atividade);
    }


    /*
     * Devolver uma questão a requisição
     * */
    public function novaQuestao($indice)
    {
        return view("atividade/partial/atividade-questao", ["indice" => $indice]);
    }

    /*
     * Detalhe da atividade
     * */
    public function detalhe($id)
    {
        $atividade = Atividade::find($id);

        if (is_null($atividade)) {
            return abort(404);
        }

        //retornar a view passando a atividade
        return view('atividade.atividade-detalhe')->with('atividade', $atividade);
    }


    /*
     * Devolver uma resposta a requisição
     * */
    public function novaResposta($indice, $valor)
    {
        return view("atividade/partial/atividade-resposta", ["indice" => $indice, "valor" => $valor]);
    }


    /*
    * Atualizar a atividade
    * */
    public function realizarAtividade(Request $request)
    {
        $dados = ($request->all());


        // dd($dados);
        try {

            DB::beginTransaction();

            $acertos = 0;
            $total = 0;
           

            foreach ($dados['questao'] as $questao_id => $questao_resposta) {
                $resposta = Resposta::find($questao_resposta['selecionada']);

                if ($resposta->correta) {
                    $acertos++;
                }

                $respondida = new  UserQuestao();
                $respondida->questao_id = $questao_id;
                $respondida->user_id = Auth::user()->id;
                $respondida->resposta = $questao_resposta['selecionada'];
                $respondida->save();

                $total++;
            }

           
            $nota = round(($acertos * 100) / $total);

            $userAtividade = new UserAtividade();
            $userAtividade->user_id = Auth::user()->id;
            $userAtividade->atividade_id = $dados['atividade_id'];
            $userAtividade->acertos = $acertos;
            $userAtividade->total_questoes = $total;
            $userAtividade->nota = $nota;
            $userAtividade->save();

            DB::commit();

            /*redirecionar para os detalhes da unidade*/

            return view('atividade.atividade-acertos')->with(['userAtividade' => $userAtividade,"unidade_id"=> $dados['unidade_id']]);
            //return redirect()->action('AtividadeController@exibeResultado', ['user_unidade'=>$user_unidade]);
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['msg', 'Não foi possível Salvar as questões!!! Contate o suporte.']);
        }

    }


    public function exibeResultado(UserAtividade $user_unidade)
    {
        return view('atividade.atividade-acertos')->with('user_unidade', $user_unidade);
    }
}
