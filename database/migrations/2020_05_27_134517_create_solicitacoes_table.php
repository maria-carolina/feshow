<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSolicitacoesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solicitacoes', function (Blueprint $table) {
            $table->integer('artista_id');
            $table->integer('espaco_id');
            $table->integer('data_id');
            $table->integer('resposta');
            $table->foreign('artista_id')->references('id')->on('artistas');
            $table->foreign('espaco_id')->references('id')->on('espacos');
            $table->foreign('data_id')->references('id')->on('datas_disponiveis');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('solicitacoes');
    }
}
