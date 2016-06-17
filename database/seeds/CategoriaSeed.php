<?php

use Illuminate\Database\Seeder;

class CategoriaSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::insert(' INSERT INTO categorias (descricao) VALUES (?)', array('Matématica'));
        DB::insert(' INSERT INTO categorias (descricao) VALUES (?)', array('Portugês'));
        DB::insert(' INSERT INTO categorias (descricao) VALUES (?)', array('História'));
        DB::insert(' INSERT INTO categorias (descricao) VALUES (?)', array('Informática'));
        DB::insert(' INSERT INTO categorias (descricao) VALUES (?)', array('Inglês'));
    }
}
