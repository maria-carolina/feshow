<?php

    Route::group(['prefix' => 'espaco/'], function() {
        Route::get('cadastrar', 'EspacoController@abrirCadastro')->name('cadastro_casa');

        Route::post('salvar', 'EspacoController@insert')->name('salvar_casa');

        Route::get('perfil/{id}', 'EspacoController@abrirPerfil')->name('abrir_perfil');

        Route::get('/perfil/{id}', 'EspacoController@abrirPerfil')->name('perfil_espaco');
    });



