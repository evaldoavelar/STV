<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ControllerCursoTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testPodeInscreverCurso()
    {
        //Abmiente
        $curso = factory(App\Curso::class)->create(['publicado'=>true]);
        $user = factory(App\User::class)->create();

        //autenticar
        $this->be($user);


        //testes
        $this->json('POST', '/inscrever-curso', ['user_id' => $user->id, 'curso_id' => $curso->id])
            ->seeStatusCode(200)
            ->seeJsonEquals([
                'inscrito' => true
            ]);
    }

    public function testNaoPodeInscreverCursoNaoPublicado()
    {
        //Abmiente
        $curso = factory(App\Curso::class)->create(['publicado' => false]);
        $user = factory(App\User::class)->create();
        //autenticar
        $this->be($user);


        //testes
        $this->json('POST', '/inscrever-curso', ['user_id' => $user->id, 'curso_id' => $curso->id])
            ->seeStatusCode(200)
            ->seeJsonEquals([
                'inscrito' => false,
                'msg' => 'Curso não publicado'
            ]);
    }

    public function testDeveRetornarFalseSeUserJaInscritoNoCurso()
    {
        //Abmiente
        $curso = factory(App\Curso::class)->create(['publicado' => true]);
        $user = factory(App\User::class)->create();
        //autenticar
        $this->be($user);


        //inscrever
        $this->json('POST', '/inscrever-curso', ['user_id' => $user->id, 'curso_id' => $curso->id])
            ->seeStatusCode(200)
            ->seeJsonEquals([
                'inscrito' => true
            ]);


        //testes
        $this->json('POST', '/inscrever-curso', ['user_id' => $user->id, 'curso_id' => $curso->id])
            ->seeStatusCode(200)
            ->seeJsonEquals([
                'inscrito' => false,
                'msg' => 'Usuário já inscrito no curso'
            ]);

    }


    public function testPodeSalvarCurso()
    {
        //Ambiente
        $curso = factory(App\Curso::class)->make();
        $user = factory(App\User::class)->create(['admin'=>true]);
        //autenticar
        $this->be($user);

        //ação
        $this->post('/curso-salvar',[$curso->toArray()])
                    ->see('ok')
                    ->seeStatusCode(302);

        //testes
        $this->assertNotEquals(0,App\Curso::all()->count());

        /*$ultimo_curso = App\Curso::latest()->first();
        $this->assertEquals($curso->id, $ultimo_curso->id);
        $this->assertEquals($curso->titulo, $ultimo_curso->titulo);
        $this->assertEquals($curso->descricao, $ultimo_curso->descricao);
        $this->assertEquals($curso->instrutor, $ultimo_curso->instrutor);
        $this->assertEquals($curso->categoria_id, $ultimo_curso->categoria_id);
        $this->assertEquals($curso->palavras_chaves, $ultimo_curso->palavras_chaves);
        $this->assertEquals($curso->publicado, $ultimo_curso->publicado);*/

    }
}
