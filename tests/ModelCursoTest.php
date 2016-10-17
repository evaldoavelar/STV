<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Categoria;
use App\Curso;
use App\Inscrito;
use App\User;
use App\CursoAvaliacao;


class ModelCursoTest extends TestCase
{

    public function testPodeIncluir()
    {
        //criar um curso fake com o ModelFactory
        $curso = factory(App\Curso::class)->create();

        //execução
        $ultimo_curso = Curso::latest()->first();

        //testes
        $this->assertEquals($curso->id, $ultimo_curso->id);
        $this->assertEquals($curso->titulo, $ultimo_curso->titulo);
        $this->assertEquals($curso->descricao, $ultimo_curso->descricao);
        $this->assertEquals($curso->instrutor, $ultimo_curso->instrutor);
        $this->assertEquals($curso->categoria_id, $ultimo_curso->categoria_id);
        $this->assertEquals($curso->palavras_chaves, $ultimo_curso->palavras_chaves);
        $this->assertEquals($curso->publicado, $ultimo_curso->publicado);

    }

    public function testPodeExcluir()
    {
        //ambiente
        $curso = factory(App\Curso::class)->create();

        $ultimo_curso = Curso::find($curso->id);
        $this->assertNotNull($ultimo_curso);

        //execução
        $ultimo_curso->delete();

        //testes
        $cursoNaoEncontrado = Curso::find($curso->id);
        $this->assertNotInstanceOf(Curso::class, $cursoNaoEncontrado);

    }


    public function testPodeEditar()
    {
        ///ambiente
        $curso = factory(App\Curso::class)->create();
        $curso->publicado = false;
        $curso->save();

        //execução
        $ultimo_curso = Curso::find($curso->id);
        //testes
        $this->assertEquals($curso->publicado, false);

        $ultimo_curso->publicado = true;
        $ultimo_curso->save();

        $cursoAlterado = Curso::find($curso->id);
        //testes
        $this->assertEquals($cursoAlterado->publicado, true);

    }

    public function testPodeListarUnidades()
    {

        //ambiente
        factory(App\Curso::class, 3)->create()->each(function ($c) {
            factory(App\Unidade::class, 'unidades', 3)->create(['curso_id' => $c->id]);
        });

        //execução
        $curso = Curso::latest()->first();

        //testes
        $this->assertEquals($curso->unidades()->count(), 3);
    }

    public function testPodeListarVideosDoCurso()
    {
        //ambiente
        factory(App\Curso::class, 1)->create()->each(function ($c) {
            factory(App\Unidade::class, 'unidades', 3)->create(['curso_id' => $c->id])
                ->each(function ($u) {
                    factory(App\Video::class, 'videos', 4)->create(['unidade_id' => $u->id]);
                });
        });

        //execução
        $curso = Curso::latest()->first();

        //testes
        $this->assertEquals(12, $curso->totalVideos());
    }


    public function testPodeListarAtividadesDoCurso()
    {
        //ambiente
        factory(App\Curso::class, 1)->create()
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
                    });
            });

        //execução
        $curso = Curso::latest()->first();

        //testes
        $this->assertEquals(3, $curso->totalAtividades());
    }


    public function testPodeListarMateriaisDoCurso()
    {
        //ambiente
        factory(App\Curso::class, 1)->create()->each(function ($c) {
            factory(App\Unidade::class, 'unidades', 3)->create(['curso_id' => $c->id])
                ->each(function ($u) {
                    factory(App\Material::class, 'materiais', 4)->create(['unidade_id' => $u->id]);
                });
        });

        //execução
        $curso = Curso::latest()->first();

        //testes
        $this->assertEquals(12, $curso->totalMateriais());
    }
}
