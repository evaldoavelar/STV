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
        $categoria_id = factory(App\Categoria::class)->create()->id;
        $curso = factory(App\Curso::class)->create(['publicado'=>true,'categoria_id'=>$categoria_id]);
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
        $this->be($user);//autenticar

        //ação
        $this->visit('/curso-novo')
            ->submitForm('Salvar Curso',[
                'titulo'=>$curso->titulo,
                'descricao'=>'Novo curso',
                'instrutor'=>$curso->instrutor,
                'categoria_id'=>$curso->categoria_id,
                'palavras_chaves'=>$curso->palavras_chaves,
            ])
            ->see('Novo curso')
            ->seeInDatabase('cursos', [
                'titulo' => $curso->titulo,
                'descricao' => 'Novo curso',
                'instrutor'=>$curso->instrutor,
                'categoria_id'=>$curso->categoria_id,
                'palavras_chaves'=>$curso->palavras_chaves,
            ]);
    }


    public function testPodeEditarCurso()
    {
        //Ambiente
        $curso = factory(App\Curso::class)->create();
        $user = factory(App\User::class)->create(['admin'=>true]);
        //autenticar
        $this->be($user);

        //ação
        $this->visit('/curso-editar/'.$curso->id)
            ->submitForm('Salvar Curso',[
                'id'=>$curso->id,
                'titulo'=>$curso->titulo,
                'descricao'=>'Nova Descrição',
                'instrutor'=>$curso->instrutor,
                'categoria_id'=>$curso->categoria_id,
                'palavras_chaves'=>$curso->palavras_chaves,
            ])
            ->see('Nova Descrição');

    }


    public function testPodeExibirDetalhesDoCurso()
    {
        //Ambiente
        $curso = factory(App\Curso::class)->create();
        $user = factory(App\User::class)->create(['admin'=>true]);
        //autenticar
        $this->be($user);

        //ação
        $this->visit('/curso-admin-detalhes/'.$curso->id)
            ->see($curso->titulo)
            ->see($curso->descricao);

    }



}
