<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('inicio');

Route::get('/cadastrar/artista', 'ArtistaController@buscarGeneros')->name('cadastro_artista');

Route::post('/salvar/artista', 'ArtistaController@insert')->name('salvar_artista');
