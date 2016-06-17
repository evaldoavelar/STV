<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableQuestoes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questoes', function (Blueprint $table) {
            $table->increments('id');
            $table->text('enunciado',200);            
            $table->integer('atividades_id')->unsigned();            
            $table->foreign('atividades_id')->references('id')->on('atividades')->onDelete('cascade');
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
      
    }
}