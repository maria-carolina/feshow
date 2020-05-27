<?php

    Route::group(['prefix' => 'evento/'], function() {
        Route::get('cadastrar', 'EventoController@abrirCadastro')->name('cadastro_evento');

        Route::post('salvar', 'EventoController@insert')->name('salvar_evento');

        Route::get('convite/{id}', 'EventoController@abrirConvite')->name('convidar_artista');

        Route::get('{id}', 'EventoController@abrirPerfil')->name('abrir_perfil');

    });
