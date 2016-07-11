<?php

use Illuminate\Database\Seeder;

class UnidadeSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::insert(' INSERT INTO unidades (id,descricao, curso_id) VALUES (?,?,?)',
            array(
                1,'Unidade 1 - Básico', 1
            ));

        DB::insert(' INSERT INTO unidades (id,descricao, curso_id) VALUES (?,?,?)',
            array(
                2,'Unidade 2 - Intermediário', 1
            ));

        DB::insert(' INSERT INTO unidades (id,descricao, curso_id) VALUES (?,?,?)',
            array(
                3,'Unidade 2 - Avançado', 1
            ));
    }
}
