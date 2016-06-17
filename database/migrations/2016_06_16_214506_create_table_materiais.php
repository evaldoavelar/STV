<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableMateriais extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('materiais', function (Blueprint $table) {
            $table->increments('id');
            $table->string('titulo',200)->unique();
            $table->string('descricao',200);
            $table->string('arquivo',max);
            $table->timestamps();
            $table->integer('curso_id');
            $table->foreign('curso_id')->references('id')->on('cursos')->onDelete('cascade');;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('materiais');
    }
}
