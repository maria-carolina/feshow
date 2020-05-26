<?php

Route::get('/', function () {
    return view('welcome');
})->name('inicio');

//Route::post('/login', 'ArtistaController@logar')->name('login');

Auth::routes();

Route::get('/home', 'UserController@index')->name('home');


