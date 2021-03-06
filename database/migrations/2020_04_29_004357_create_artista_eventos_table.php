<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArtistaEventosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('artistas_eventos', function (Blueprint $table) {
            $table->integer('artista_id');
            $table->integer('evento_id');
            $table->integer('resposta');
            $table->timestamps();
            $table->foreign('artista_id')->references('id')->on('artistas');
            $table->foreign('evento_id')->references('id')->on('eventos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('artistas_eventos');
    }
}
