<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

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


    public function register(Request $request)
    {
        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }

        $this->create($request->all());

        return redirect('/usuario-lista');
    }

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

    public function lista(Request $request)
    {

        
        
        $usuarios = User::all();

        //return view('auth.list')->with($usuarios);
        return view('auth/list')->with('usuarios', $usuarios);
    }

    public function edit($id)
    {
        $usuario = User::find($id);

        if (is_null($usuario)) abort(404);

        return view('auth/edit')->with('usuario', $usuario);
    }

    public function delete($id)
    {
        $usuario = User::find($id);

        if (is_null($usuario)) abort(404);

        $usuario->delete();

        return redirect('/usuario-lista');
    }

}
