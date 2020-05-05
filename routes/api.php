<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Genero;
use App\Artista;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/listarGeneros', function(){
    $generos = Genero::all();
    return Response::json($generos);
})->name('api.listarGeneros');


Route::get('/pesquisarArtista/{nome}', function($nome){
    
    $resultado = Artista::where('artistas.nome', urldecode($nome))
    ->join('artistas_generos', 'artistas.id', '=', 'artistas_generos.artista_id')
    ->join('generos', 'generos.id', '=', 'artistas_generos.genero_id')
    ->select('artistas.*', 'generos.nome as genero')
    ->get();
    return Response::json($resultado);
})->name('api.pesquisarArtista');
