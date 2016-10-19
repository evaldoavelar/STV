<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CursoControllerTest extends TestCase
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
        $curso = factory(App\Curso::class)->create(['publicado' => true, 'categoria_id' => $categoria_id]);
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
        $user = factory(App\User::class)->create(['admin' => true]);
        $this->be($user);//autenticar

        //ação
        $this->visit('/curso-novo')
            ->submitForm('Salvar Curso', [
                'titulo' => $curso->titulo,
                'descricao' => 'Novo curso',
                'instrutor' => $curso->instrutor,
                'categoria_id' => $curso->categoria_id,
                'palavras_chaves' => $curso->palavras_chaves,
            ])
            ->see('Novo curso')
            ->seeInDatabase('cursos', [
                'titulo' => $curso->titulo,
                'descricao' => 'Novo curso',
                'instrutor' => $curso->instrutor,
                'categoria_id' => $curso->categoria_id,
                'palavras_chaves' => $curso->palavras_chaves,
            ]);
    }


    public function testPodeEditarCurso()
    {
        //Ambiente
        $curso = factory(App\Curso::class)->create();
        $user = factory(App\User::class)->create(['admin' => true]);
        //autenticar
        $this->be($user);

        //ação
        $this->visit('/curso-editar/' . $curso->id)
            ->submitForm('Salvar Curso', [
                'id' => $curso->id,
                'titulo' => $curso->titulo,
                'descricao' => 'Nova Descrição',
                'instrutor' => $curso->instrutor,
                'categoria_id' => $curso->categoria_id,
                'palavras_chaves' => $curso->palavras_chaves,
            ])
            ->see('Nova Descrição')
            ->seeInDatabase('cursos', [
                'titulo' => $curso->titulo,
                'descricao' => 'Nova Descrição',
                'instrutor' => $curso->instrutor,
                'categoria_id' => $curso->categoria_id,
                'palavras_chaves' => $curso->palavras_chaves,
            ]);

    }


    public function testPodeExibirDetalhesDoCurso()
    {
        //Ambiente
        $curso = factory(App\Curso::class)->create();
        $user = factory(App\User::class)->create(['admin' => true]);
        //autenticar
        $this->be($user);

        //ação
        $this->visit('/curso-admin-detalhes/' . $curso->id)
            ->see($curso->titulo)
            ->see($curso->descricao);

    }

    public function testPodeListarCursoPorTitulo()
    {
        //Ambiente
        $curso = factory(App\Curso::class)->create(['publicado' => true]);
        factory(App\Curso::class, 5)->create(['publicado' => true]);
        $user = factory(App\User::class)->create(['admin' => true]);
        //autenticar
        $this->be($user);

        //ação
        $this->visit('/curso-lista')
            ->submitForm('Filtrar', [
                'valor' => $curso->titulo,
                'campo' => 'titulo',
            ])
            ->see($curso->titulo);

        //ação
        $this->visit('/curso-lista')
            ->submitForm('Filtrar', [
                'valor' => $curso->instrutor,
                'campo' => 'titulo',
            ])
            ->see($curso->titulo);

    }

    public function testPodeListarCursoPorCategoria()
    {
        //Ambiente
        $categoria_id = factory(App\Categoria::class)->create()->id;
        factory(App\Curso::class, 5)->create(['categoria_id' => $categoria_id, 'publicado' => true]);
        $user = factory(App\User::class)->create(['admin' => true]);
        //autenticar
        $this->be($user);

        $this->visit('/cursos-por-categoria/' . $categoria_id)
            ->see('Instrutor');
    }

    public function testPodePublicarCurso()
    {

        //Ambiente
        $this->CriaCursoCompleto();
        $user = factory(App\User::class)->create(['admin' => true]);
        //autenticar
        $this->be($user);

        //execução
        $curso = App\Curso::latest()->first();

        //ação
        $this->visit('/curso-publicar/' . $curso->id)
            ->see('Curso publicado com sucesso!');

    }


    public function testPodeDespublicarCurso()
    {

        //Ambiente
        $this->CriaCursoCompleto(['publicado'=>true]);
        $user = factory(App\User::class)->create(['admin' => true]);
        //autenticar
        $this->be($user);

        //execução
        $curso = App\Curso::latest()->first();

        //ação
        $this->visit('/curso-despublicar/' . $curso->id)
            ->see('Curso despublicado com sucesso!');

    }

    public function testNaoPodePublicarCursoSemUnidade()
    {
        //Ambiente
        $curso = factory(App\Curso::class)->create();
        $user = factory(App\User::class)->create(['admin' => true]);
        //autenticar
        $this->be($user);

        //ação
        $this->visit('/curso-publicar/' . $curso->id)
            ->see('Cadastre ao menos uma unidade para publicar o curso.');

    }

    //retorna um curso com unidades, atividades, videos e atividadades
    public function CriaCursoCompleto($parametros = array('publicado' => true))
    {
        factory(App\Curso::class, 1)->create(['publicado' => $parametros['publicado']])
            ->each(function ($c) {
                factory(App\Unidade::class, 'unidades', 3)->create(['curso_id' => $c->id])
                    ->each(function ($u) {
                        factory(App\Atividade::class, 'atividades', 1)->create(['unidade_id' => $u->id])
                            ->each(function ($a) {
                                factory(App\Questao::class, 'questoes', 4)->create(['atividade_id' => $a->id])
                                    ->each(function ($q) {
                                        factory(App\Resposta::class, 'respostas', 4)->create(['questao_id' => $q->id]);
                                    });
                            });
                        factory(App\Video::class, 'videos', 4)->create(['unidade_id' => $u->id]);

                        factory(App\Material::class, 'materiais', 4)->create(['unidade_id' => $u->id]);

                    });
            });
    }
}
