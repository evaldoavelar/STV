<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Library\Util;
use Validator;
use DB;
use App\Http\Controllers\Controller;
//use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Barryvdh\Snappy\Facades\SnappyPdf;
use Illuminate\Support\Facades\Request;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';
    protected $redirectPath = '/';
    protected $redirectAfterLogout = '/';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //  $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
        $this->middleware('autorizacaoAdmin', ['except' => ['logout', 'login']]);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Get a validator for an incoming registration request on update.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validatorPost(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'password' => 'min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'ativo' => isset($data['ativo']) ? true : false,
            'admin' => isset($data['admin']) ? true : false,
            'password' => bcrypt($data['password']),
        ]);
    }


    /**
     *  SObrescrever o Metodo Padrão de Registrar Usuario
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Foundation\Validation\ValidationException
     */
    public function register(Request $request)
    {
        $validator = $this->validator(Request::all());

        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }

        $user = $this->create(Request::all());

        return view('auth/edit')->with(['usuario'=> $user,'msg'=>"Usuário salvo com Sucesso!"]);
       // return redirect('/usuario-lista');
    }


    /**
     *  Atualizar Usuario
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Foundation\Validation\ValidationException
     */
    public function salvar(Request $request)
    {
        $validator = $this->validatorPost($request->all());

        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }

        $usuario = User::find($request['id']);
        if (is_null($usuario)) abort(404);

        $data = $request->all();

        $usuario->name = $data['name'];
        $usuario->email = $data['email'];
        $usuario->ativo = isset($data['ativo']) ? true : false;
        $usuario->admin = isset($data['admin']) ? true : false;
        if (isset($data['password']) && trim($data['password']) != "")
            $usuario->password = bcrypt($data['password']);

        $usuario->save();

        return redirect('/usuario-lista');
    }


    /**
     * Listar Usuário
     */
    public function lista(Request $request,$msg = null)
    {
        //Recuperar os parametros da requisição
        $data = Request::all();

        //verifcar se está usando o filtro
        if ( Util::checkIsNullAndEmpty($data,'campo') && Util::checkIsNullAndEmpty($data,'valor')  ){
            //filtrar os usuários
            $usuarios = User::where($data['campo'], "LIKE", $data['valor'] . '%')->get();

            //retornar a consulta e os campos do filtro para a view
            return view('auth/list')->with(['usuarios' => $usuarios, 'valor' => $data['valor'], 'campo' => $data['campo'],'msg'=>$msg]);
            // dd(DB::getQueryLog());
        } else {
            $usuarios = [];
            return view('auth/list')->with(['usuarios' => $usuarios,'msg'=>$msg]);
        }

    }

    /**
     * Editar Usuário
     */
    public function edit($id)
    {
        $usuario = User::find($id);

        if (is_null($usuario)) abort(404);

            return view('auth/edit')->with('usuario', $usuario);
    }


    /**
     * Exlcuir Usuário
     */
    public function delete($id)
    {
        $msg = "Usuário excluido com sucesso!";

        $usuario = User::find($id);
        if (is_null($usuario)) abort(404);

     //   $usuario->delete();

        $this->lista( Request::instance(),$msg);
    }

    public function relatorio($id)
    {
        $usuario = User::find($id);
        if (is_null($usuario)) abort(404);

        $cursos = $usuario->cursos()->get();

        foreach ($cursos as $curso) {
            $curso->notas = $curso->RetornaNotaUsuarioCurso($id);
            $curso->aprovado = $curso->aprovado($id);
            $curso->PorcetagemAssistidos = $curso->RetornaPorcentagemVideosAssistidos($id);
        }

        $dados = [
            'nome' => $usuario->name,
            'cursos' => $cursos,
            'data' =>  date('d/m/Y'),
        ];
        

        $pdf = SnappyPdf::loadView('auth/usuario-relatorio', $dados);
        return $pdf->setPaper('a4')->stream();

      //  return view('auth/usuario-relatorio')->with($dados);
    }
}
