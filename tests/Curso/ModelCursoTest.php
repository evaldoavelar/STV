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

        $ultimo_curso = Curso::latest()->first();

        $this->assertEquals($curso->id, $ultimo_curso->id);
        $this->assertEquals($curso->titulo, $ultimo_curso->titulo);
        $this->assertEquals($curso->descricao, $ultimo_curso->descricao);
        $this->assertEquals($curso->instrutor,$ultimo_curso->instrutor);
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

        //teste
        $ultimo_curso->delete();

        //asserção
        $cursoNaoEncontrado = Curso::find($curso->id);
        $this->assertNotInstanceOf(Curso::class,$cursoNaoEncontrado);

    }


    public function testPodeEditar()
    {
        //criar um curso fake com o ModelFactory
        $curso = factory(App\Curso::class)->create();
        $curso->publicado = false;
        $curso->save();

        $ultimo_curso = Curso::find($curso->id);
        $this->assertEquals($curso->publicado, false);

        $ultimo_curso->publicado = true;
        $ultimo_curso->save();

        $cursoAlterado = Curso::find($curso->id);
        $this->assertEquals($cursoAlterado->publicado, true);

    }

    public function testPodeListarUnidades()
    {
        //criar um curso fake com o ModelFactory
        $curso = factory(App\Curso::class)
            ->create()
            ->each(function($c) {
                $c->unidades()->save(factory('App\Unidade')->make());
            });


        $this->assertEquals( $curso->unidades()->count(),2);

    }

}
