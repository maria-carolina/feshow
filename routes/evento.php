<?php

    Route::group(['prefix' => 'evento/'], function() {
        Route::get('cadastrar', 'EventoController@abrirCadastro')->name('cadastro_evento');

        Route::post('cadastrar', 'EventoController@abrirCadastroData')->name('cadastro_evento_data');

        Route::post('salvar', 'EventoController@insert')->name('salvar_evento');

        Route::post('alterar/{id}', 'EventoController@update')->name('alterar_evento');

        Route::get('editar/{id}', 'EventoController@abrirEdicao')->name('abrir_edicao');

        Route::get('convite/{id}', 'EventoController@abrirConvite')->name('convidar_artista');

        Route::get('{id}', 'EventoController@abrirPerfil')->name('abrir_perfil');

        Route::get('agenda/{id}', 'EventoController@agenda')->name('agenda');

        Route::post('solicitar/{idArtista}/{idEspaco}', 'EventoController@solicitarEvento')->name('solicitar_evento');

        Route::get('{idArtista}/criarSolicitacao/{idSolicitacao}', 'EventoController@abrirCadastroSolicitado')->name('evento_solicitado');

        Route::post('salvar/solicitacao/{idSolicitacao}', 'EventoController@insertEventoSolicitado')->name('salvar_evento_solicitacao');

        Route::get('deletar/solicitacao/{idSolicitacao}', 'EventoController@deleteEventoSolicitado')->name('apagar_evento_solicitacao');

    });
