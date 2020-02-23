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

Route::post('/login', 'ArtistaController@logar')->name('login');

Route::get('/cadastrar/casa', 'CasaController@abrirCadastro')->name('cadastro_casa');

Route::post('/salvar/casa', 'CasaController@insert')->name('salvar_casa');

Auth::routes();

Route::post('/home', 'HomeController@index')->name('home');
