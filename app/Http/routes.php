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
    Route::get('/usuario-relatorio/{id}', 'Auth\AuthController@relatorio')->where('id', '[0-9]+');

    /*------------------- Home ------------------------*/

    Route::get('/', 'HomeController@home');
    Route::get('/home', 'HomeController@home');


    /*------------------- Curso ------------------------*/
    Route::get('/curso-novo', 'CursoController@novo');
    Route::post('/curso-salvar', 'CursoController@salvar');
    Route::post('/curso-atualizar', 'CursoController@atualizar');
    Route::get('/curso-excluir/{id}', 'CursoController@excluir')->where('id', '[0-9]+');
    Route::get('/curso-lista', 'CursoController@lista');
    Route::get('/curso-admin-detalhes/{id}', 'CursoController@detalhesAdmin')->where('id', '[0-9]+');
    Route::get('/curso-admin-detalhes/{id}/{unidade}', 'CursoController@detalhesAdmin')->where(['id' => '[0-9]+','unidade' => '[0-9]+']);
    Route::get('/curso-editar/{id}', 'CursoController@editar')->where('id', '[0-9]+');

    Route::get('/meus-cursos', 'CursoController@meusCursos');
    Route::get('/cursos-por-categoria/{categoria_id}', 'CursoController@cursoPorCategoria')->where('categoria_id', '[0-9]+');
    Route::post('/inscrever-curso', 'CursoController@inscreverCurso');
    Route::get('/curso-detalhes/{id}', 'CursoController@detalhesUsuario')->where('id', '[0-9]+');
    Route::get('/curso-avaliacao/{id}/{nota}', 'CursoController@avaliacao')->where(['id' => '[0-9]+','nota' => '[1-5]+']);
    Route::get('/curso-publicar/{id}', 'CursoController@publicar')->where('id', '[0-9]+');
    Route::get('/curso-despublicar/{id}', 'CursoController@despublicar')->where('id', '[0-9]+');
    Route::get('/curso-certificado/{id}', 'CursoController@certificado')->where('id', '[0-9]+');
    Route::get('/curso-pesquisa', 'CursoController@pesquisa');
    

    /*------------------- Unidade ------------------------*/
    Route::get('/unidade-novo/{curso_id}','UnidadeController@novo')->where('curso_id', '[0-9]+');
    Route::post('/unidade-salvar', 'UnidadeController@salvar');
    Route::post('/unidade-atualizar', 'UnidadeController@atualizar');
    Route::get('/unidade-excluir/{id}', 'UnidadeController@excluir')->where('id', '[0-9]+');
    Route::get('/unidade-editar/{id}', 'UnidadeController@editar')->where('id', '[0-9]+');
    Route::get('/unidade-detalhe/{id}', 'UnidadeController@detalhe')->where('id', '[0-9]+');

    /*------------------- Material ------------------------*/        
    Route::get('/material-novo/{curso_id}','MaterialController@novo')->where('curso_id', '[0-9]+');
    Route::get('/material-editar/{id}','MaterialController@editar')->where('id', '[0-9]+');
    Route::get('/material-excluir/{id}','MaterialController@excluir')->where('id', '[0-9]+');
    Route::post('/material-salvar','MaterialController@salvar');
    Route::post('/material-atualizar','MaterialController@atualizar');
    Route::get('/material-download/{id}','MaterialController@download')->where('id', '[0-9]+');    

    /*------------------- Vídeos ------------------------*/
    Route::get('/video-novo/{curso_id}','VideoController@novo')->where('curso_id', '[0-9]+');
    Route::get('/video-editar/{id}','VideoController@editar')->where('id', '[0-9]+');
    Route::get('/video-excluir/{id}','VideoController@excluir')->where('id', '[0-9]+');
    Route::post('/video-salvar','VideoController@salvar');
    Route::post('/video-atualizar','VideoController@atualizar');
    Route::get('/video-detalhe/{id}','VideoController@detalhe')->where('id', '[0-9]+');
    Route::post('/marcar-assitido', 'VideoController@marcarAssitido');


    /*Rotas Atividade */
    Route::get('/atividade-questao/{indice}','AtividadeController@novaQuestao')->where('indice', '[0-9]+');
    Route::get('/atividade-resposta/{indice}/{valor}','AtividadeController@novaResposta')->where('valor', '[0-9]+');
    Route::post('/atividade/salvar', 'AtividadeController@salvar');
    Route::post('/atividade/atualizar', 'AtividadeController@atualizar');
    Route::get('/atividade-novo/{unidade_id}','AtividadeController@novo')->where('unidade_id', '[0-9]+');
    Route::get('/atividade-editar/{id}','AtividadeController@editar')->where('id', '[0-9]+');
    Route::get('/atividade-excluir/{id}','AtividadeController@excluir')->where('id', '[0-9]+');
    Route::get('/atividade-detalhe/{id}','AtividadeController@detalhe')->where('id', '[0-9]+');
    Route::post('/realizar-atividade', 'AtividadeController@realizarAtividade');

    
});




Route::get('/curso-video', function () {
    return view('cursos/curso-video');
});



Route::get('/categorias', function () {
    return view('cursos/listagem-categorias');
});



Route::get('/curso-cadastro-video', function () {
    return view('cursos/curso-cadastro-video');
});





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
