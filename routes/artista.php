<?php

    Route::group(['prefix' => 'artista/'], function() {

        Route::get('cadastrar', 'ArtistaController@abrirCadastro')->name('cadastro_artista');

        Route::post('salvar', 'ArtistaController@insert')->name('salvar_artista');

        Route::get('/editar/{id}', 'ArtistaController@abrirEdicao')->name('abrir_edicao');

        Route::post('alterar/{id}', 'ArtistaController@update')->name('alterar_artista');

        Route::get('/perfil/{id}', 'ArtistaController@abrirPerfil')->name('perfil_artista');

        Route::get('/convites/{id}', 'ArtistaController@abrirConvites')->name('abrir_convites');

        Route::get('/feed/{id}', 'ArtistaController@abrirFeed')->name('feed_artista');

        Route::get('eventos/{id}', 'ArtistaController@abrirEventos')->name('eventos_artista');

    });
