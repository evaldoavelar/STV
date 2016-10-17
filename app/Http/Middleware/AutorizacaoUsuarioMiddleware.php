<?php

namespace App\Http\Middleware;

use Closure;

class AutorizacaoUsuarioMiddleware
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

       // echo 'Autorizando';

        //se o usuario não está logado, redireciona para login
        if (!$request->is('auth/login') && \Auth::guest()) {
            echo 'Não autorizado '.$request->is('auth/login');
            // return redirect('/auth/login');

            //adicionar a propriedade
            //protected $redirectPath = '/';
            //no AuthController para redirecionar para  apágina de origem
            return redirect()->guest('/login');
        }

        // print_r($request);


        return $next($request);
    }
}
