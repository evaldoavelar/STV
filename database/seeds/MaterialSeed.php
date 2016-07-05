<?php

use Illuminate\Database\Seeder;

class MaterialSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::insert(' INSERT INTO materiais (titulo, descricao, arquivo, curso_id) VALUES (?,?,?,?)',
            array(
                'Matématica Avançada', 'wewewe3333344', 'D:\\xampp\\htdocs\\STV\\uploads\\cursos\\material\\1\\577be7d607c50\\tela 4.png', 1,
        ));

        DB::insert(' INSERT INTO materiais (titulo, descricao, arquivo, curso_id) VALUES (?,?,?,?)',
            array(
                'Informática e Matemática', 'dsfsfsdf', 'D:\\xampp\\htdocs\\STVuploads\\cursos\\material\\\\ 1\\577bc238db7fetabelas.png', 1
            ));
    }
}
