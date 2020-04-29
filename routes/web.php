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


Route::get('/cadastrar/artista', 'ArtistaController@abrirCadastro')->name('cadastro_artista');

Route::post('/salvar/artista', 'ArtistaController@insert')->name('salvar_artista');

Route::get('/editar/artista/{id}', 'ArtistaController@abrirEdicao')->name('abrir_edicao');

Route::post('/alterar/artista/{id}', 'ArtistaController@update')->name('alterar_artista');

Route::post('/login', 'ArtistaController@logar')->name('login');

Route::get('/perfil/artista/{id}', 'ArtistaController@abrirPerfil')->name('abrir_perfil');

//////

Route::get('/cadastrar/espaco', 'EspacoController@abrirCadastro')->name('cadastro_casa');

Route::post('/salvar/espaco', 'EspacoController@insert')->name('salvar_casa');

Route::get('/perfil/espaco/{id}', 'EspacoController@abrirPerfil')->name('abrir_perfil');

Auth::routes();

Route::post('/home', 'HomeController@index')->name('home');


