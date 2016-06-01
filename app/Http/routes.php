<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/1', function () {
    return view('welcome');
});
Route::get('/', 'teste@index');

Route::get('/teste', 'teste@index');

Route::get('/home', function () {
    return view('home/home');
});


Route::get('/curso-video', function () {
    return view('cursos/curso-video');
});

Route::get('/meus-cursos', function () {
    return view('cursos/meus-cursos');
});


Route::get('/categorias', function () {
    return view('cursos/listagem-categorias');
});

Route::get('/curso-lista', function () {
    return view('cursos/curso-listagem');
});

Route::get('/curso-detalhes', function () {
    return view('cursos/curso-usuario-detalhes');
});

Route::get('/curso-admin-detalhes', function () {
    return view('cursos/curso-admin-detalhes');
});

Route::get('/usuario-lista', function () {
    return view('usuario/usuario-listagem');
});

Route::get('/usuario-cadastro', function () {
    return view('usuario/usuario-cadastro');
});

Route::get('/curso-cadastro', function () {
    return view('cursos/curso-cadastro');
});

Route::get('/curso-cadastro-video', function () {
    return view('cursos/curso-cadastro-video');
});


Route::get('/curso-cadastro-material', function () {
    return view('cursos/curso-cadastro-material');
});

Route::get('/curso-cadastro-atividade', function () {
    return view('cursos/curso-cadastro-atividade');
});

Route::get('/atividade-questao', function () {
    return view('cursos/partial/atividade-questao');
});

/*Rotas Atividade */
Route::get('/atividade-resposta/{valor}','AtividadeController@novaResposta')->where('valor', '[0-9]+');;
Route::post('/atividade/salvar', 'AtividadeController@salvar');

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    //
});
