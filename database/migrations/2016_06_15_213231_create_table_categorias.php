<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableCategorias extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categorias', function (Blueprint $table) {
            $table->increments('id');
            $table->string('descricao',100);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('videos');
        Schema::dropIfExists('materiais');
        Schema::dropIfExists('respostas');
        Schema::dropIfExists('questoes');
        Schema::dropIfExists('atividades');
        Schema::dropIfExists('unidades');
      //  Schema::dropIfExists('inscritos');
        Schema::dropIfExists('cursos');
        Schema::dropIfExists('categorias');
        Schema::dropIfExists('UserCursos');
        Schema::dropIfExists('user_unidade');
        Schema::dropIfExists('user_questoes');
        Schema::dropIfExists('user_videos');




    }
}
