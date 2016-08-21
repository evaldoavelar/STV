<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableUserAtividade extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_atividade', function (Blueprint $table) {
            $table->increments('id');
            $table->float('nota');
            $table->integer('acertos');
            $table->integer('total_questoes');
            $table->integer('atividade_id')->unsigned();
            $table->foreign('atividade_id')->references('id')->on('atividades')->onDelete('cascade');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

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
        //
    }
}
