<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CategoriaSeed::class);
        $this->call(CursoSeed::class);
        $this->call(MaterialSeed::class);
        $this->call(UnidadeSeed::class);
    }
}
