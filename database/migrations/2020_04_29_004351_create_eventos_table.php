<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eventos', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->string('nome',30);
            $table->string('descricao');
            $table->time('hora_inicio');
            $table->time('hora_fim');
            $table->date('data_inicio');
            $table->date('data_fim');
            $table->integer('espaco_id');
            $table->foreign('espaco_id')->references('id')->on('espacos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('eventos');
    }
}
