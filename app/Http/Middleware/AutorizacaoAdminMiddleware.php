<?php

namespace App\Http\Middleware;

use Closure;

class AutorizacaoAdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //1 adicionar o nome dessa classe dentro da classe kernel no diretorio app/http  no atributo middleware e $routeMiddleware
        //no construtor do controller,  dizer quais metodos serao filtrados.

        echo 'Autorizando';

        //se o usuario não está logado, redireciona para login
        if (!$request->is('auth/login') && \Auth::guest()) {

            // return redirect('/auth/login');

            //adicionar a propriedade
            //protected $redirectPath = '/';
            //no AuthController para redirecionar para  apágina de origem
            return redirect()->guest('/login');
        }elseif ( ! \Auth::user()->admin){
            abort(403,'Usuário não tem perfil de Administrador');
        }



        // print_r($request);


        return $next($request);
    }
}
