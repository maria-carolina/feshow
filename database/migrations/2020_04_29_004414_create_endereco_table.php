<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnderecoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enderecos', function (Blueprint $table) {
            $table->string('cep',9);
            $table->string('logradouro', 40);
            $table->string('numero', 4);
            $table->string('bairro', 40);
            $table->string('cidade', 40);
            $table->string('uf', 2);
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
        Schema::dropIfExists('endereco');
    }
}
