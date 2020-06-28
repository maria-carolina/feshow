<?php

    Route::group(['prefix' => 'espaco/'], function() {
        Route::get('cadastrar', 'EspacoController@abrirCadastro')->name('cadastro_casa');

        Route::post('salvar', 'EspacoController@insert')->name('salvar_casa');

        Route::get('/perfil/{id}', 'EspacoController@abrirPerfil')->name('perfil_espaco');

        Route::get('/convites/{id}', 'EspacoController@abrirConvites')->name('abrir_convites');

        Route::get('/feed/{id}', 'EspacoController@abrirFeed')->name('feed_espaco');

        Route::get('/solicitacoes/', 'EspacoController@verSolicitacoes')->name('solicitacao_espaco');

    });



