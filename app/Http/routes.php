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

Route::group(['middleware' => ['web']], function () {

    /*------------------- Auth ------------------------*/
    Route::auth();
  //  Route::post('/usuario-lista', 'Auth\AuthController@lista');
    Route::get('/usuario-lista', 'Auth\AuthController@lista');
    Route::get('/usuario-editar/{id}', 'Auth\AuthController@edit')->where('id', '[0-9]+');
    Route::get('/usuario-excluir/{id}', 'Auth\AuthController@delete')->where('id', '[0-9]+');
    Route::post('/usuario-salvar', 'Auth\AuthController@salvar');

    /*------------------- Home ------------------------*/
    Route::get('/', function () {
        return view('home/home');
    });

    Route::get('/home', function () {
        return view('home/home');
    });



    /*------------------- Curso ------------------------*/
    Route::get('/curso-novo', 'CursoController@novo');
    Route::post('/curso-salvar', 'CursoController@salvar');
    Route::post('/curso-atualizar', 'CursoController@atualizar');
    Route::get('/curso-excluir', 'CursoController@excluir');
    Route::get('/curso-lista', 'CursoController@lista');
    Route::get('/curso-admin-detalhes/{id}', 'CursoController@detalhesAdmin')->where('id', '[0-9]+');
    Route::get('/curso-editar/{id}', 'CursoController@editar')->where('id', '[0-9]+');

    /*------------------- Unidade ------------------------*/
    Route::get('/unidade-novo/{curso_id}','UnidadeController@novo')->where('curso_id', '[0-9]+');
    Route::post('/unidade-salvar', 'UnidadeController@salvar');
    Route::post('/unidade-atualizar', 'UnidadeController@atualizar');
    Route::get('/unidade-excluir', 'UnidadeController@excluir');
    Route::get('/unidade-editar/{id}', 'UnidadeController@editar')->where('id', '[0-9]+');

    /*------------------- Material ------------------------*/        
    Route::get('/material-novo/{curso_id}','MaterialController@novo')->where('curso_id', '[0-9]+');
    Route::get('/material-editar/{id}','MaterialController@editar')->where('id', '[0-9]+');
    Route::get('/material-excluir/{id}','MaterialController@excluir')->where('id', '[0-9]+');
    Route::post('/material-salvar','MaterialController@salvar');
    Route::post('/material-atualizar','MaterialController@atualizar');
    Route::get('/material-download/{id}','MaterialController@download')->where('id', '[0-9]+');    

    /*------------------- Vídeos ------------------------*/
    Route::get('/video-novo/{curso_id}','VideoController@novo')->where('curso_id', '[0-9]+');
    Route::get('/editar-video/{id}','VideoController@editar')->where('id', '[0-9]+');
    Route::get('/excluir-video/{id}','VideoController@excluir')->where('id', '[0-9]+');
    Route::post('/video-salvar','VideoController@salvar');
    Route::post('/video-atualizar','VideoController@atualizar');
    
});




Route::get('/curso-video', function () {
    return view('cursos/curso-video');
});

Route::get('/meus-cursos', function () {
    return view('cursos/meus-cursos');
});

Route::get('/cursos-por-categoria', function () {
    return view('cursos/cursos-por-categoria');
});


Route::get('/categorias', function () {
    return view('cursos/listagem-categorias');
});



Route::get('/curso-detalhes', function () {
    return view('cursos/curso-usuario-detalhes');
});



Route::get('/usuario-cadastro', function () {
    return view('usuario/usuario-cadastro');
});


Route::get('/curso-cadastro-video', function () {
    return view('cursos/curso-cadastro-video');
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
/*
Route::group(['middleware' => 'web'], function () {
    Route::auth();
    Route::get('/home', 'HomeController@index');

    Route::controllers([
        'auth' => 'Auth\AuthController',
        'password' => 'Auth\PasswordController',
    ]);
});

 */
