<?php

use Illuminate\Database\Seeder;

class CursoSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::insert(' INSERT INTO cursos ( titulo ,  descricao ,  instrutor ,  categoria_id ,  palavras_chaves ) VALUES (?,?,?,?,?)', array(
            'Matématica Avançada', 'Curso de Matemática para ENEM! O curso de matemática foi formulado de modo a ser prático, básico e objetivo, contemplando os assuntos mais requeridos', 'José', 1, 'Matématica, Algebra, Ciência'
        ));

        DB::insert(' INSERT INTO cursos ( titulo ,  descricao ,  instrutor ,  categoria_id ,  palavras_chaves ) VALUES (?,?,?,?,?)', array(
            'Português Avançado', 'Cursos Gratuitos com Certificação, Português. Língua Portuguesa e Prática de ... Curso online Língua Portuguesa e Prática de Produção Textual', 'Maria Isabel', 2, 'Português Curso', '2016-06-17 20:24:10'
        ));

        DB::insert(' INSERT INTO cursos ( titulo ,  descricao ,  instrutor ,  categoria_id ,  palavras_chaves ) VALUES (?,?,?,?,?)', array(
            'Curso de Gestão', 'Se você procura um ensino de qualidade para aprender a gerir melhor o seu negócio ou subir na carreira, faça um dos cursos a distância', 'Lauro Luiz', 3, 'Curso de TI '
        ));
    }
}
