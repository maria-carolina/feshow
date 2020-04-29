<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEspacosDatasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('espacos_datas', function (Blueprint $table) {
            $table->integer('espaco_id');
            $table->integer('data_id');
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
        Schema::dropIfExists('espacos_datas');
    }
}
