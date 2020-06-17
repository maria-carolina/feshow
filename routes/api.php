<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;
use App\Genero;
use App\Artista;
use App\Evento;
use App\ArtistasEvento;

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


Route::get('/pesquisarArtista/{nome}/{idEvento}', function($nome, $idEvento){

    $resultado = Artista::where('artistas.nome', urldecode($nome))
    ->join('artistas_generos', 'artistas.id', '=', 'artistas_generos.artista_id')
    ->join('generos', 'generos.id', '=', 'artistas_generos.genero_id')
    ->select('artistas.*', 'generos.nome as genero')
    ->get();

    
    $cont = 0;
    foreach($resultado as $linha){
        $jaExiste = ArtistasEvento::where([['evento_id', $idEvento], 
            ['artista_id', $linha->id]])->get();
            
        if($jaExiste->first()){
            unset($resultado[$cont]);
        }
        $cont++;
    }

    return Response::json($resultado);
})->name('api.pesquisarArtista');

Route::get('/enviarconvite/{idEvento}/{idArtista}/{status}', function($idEvento, $idArtista, $status){
    $jaExiste = ArtistasEvento::where([['evento_id', $idEvento],
        ['artista_id', $idArtista]])->get();

    if(!$jaExiste->first()){
        $artistaevento = new ArtistasEvento();
        $artistaevento->evento_id = $idEvento;
        $artistaevento->artista_id = $idArtista;
        $artistaevento->resposta = $status; //0-aguardando resposta do espaço, 1-aguardando resposta do artista
        $artistaevento->save();
        $salvo = 1;
    }else{
        $salvo = 0;
    }
    return Response::json($salvo);
})->name('api.enviarconvite');

Route::get('/responderConvite/{idEvento}/{idArtista}/{resposta}', function($idEvento, $idArtista, $resposta){
    $artistaevento = ArtistasEvento::where([['evento_id', $idEvento],
        ['artista_id', $idArtista]])->first();

    if($resposta == 0){
        $artistaevento->resposta = 2;
        $artistaevento->save();
    }else{
        $artistaevento->delete();
    }
    return Response::json('ok');
})->name('api.responderConvite');


Route::get('/acharIdArtista/{idUser}', function($idUser){
    $artista = Artista::where('user_id', $idUser)->first();
    //dd($artista);
    return Response::json($artista);
})->name('api.acharIdArtista');


Route::get('/listareventos/{id}', function($id){
    $eventos = Evento::where('espaco_id', $id)
        ->get();

    return Response::json($eventos);
})->name('api.listareventos');

Route::get('/agenda/{idEspaco}', function($idEspaco){
    $eventos = Evento::where('espaco_id', $idEspaco)->get();
    foreach($eventos as $evento)
    {
        $data[] = array(
            'id'   => $evento->id,
            'title'   => $evento->nome,
            'start'   => $evento->data_inicio,
            'end'   => $evento->data_fim
        );
    }
    return  Response::json($data);
})->name('api.agenda');
