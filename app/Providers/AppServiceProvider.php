<?php

namespace App\Providers;

use App\Artista;
use App\ArtistasEvento;
use App\Espaco;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('layouts.index', function($view) {
            if (Auth::check()){
                if (Auth::user()->tipo_usuario == 0){
                    $idEspaco = Espaco::where('user_id', Auth::user()->id)->first()->id;

                    $notificacoes = ArtistasEvento::join('artistas', 'artista_id', 'artistas.id', '')
                        ->join('eventos', 'evento_id', 'eventos.id', '')
                        ->select('artistas.nome as artista', 'eventos.nome as evento', 'eventos.id as evento_id')
                        ->where([
                            ['eventos.espaco_id', $idEspaco],
                            ['artistas_eventos.resposta', 2] //1- enviada pelo artista
                        ])
                        ->orderBy('updated_at', 'DESC')
                        ->orderBy('created_at', 'DESC')
                        ->get();

                } else {
                    $idArtista = Artista::where('user_id', Auth::user()->id)->first()->id;
                    $notificacoes = ArtistasEvento::join('artistas', 'artista_id', 'artistas.id', '')
                        ->join('eventos', 'evento_id', 'eventos.id', '')
                        ->join('espacos', 'eventos.espaco_id', 'espacos.id', '')
                        ->select('espacos.nome as espaco', 'eventos.nome as evento', 'eventos.id as evento_id')
                        ->where([
                            ['artistas_eventos.artista_id', $idArtista],
                            ['artistas_eventos.resposta', 2] //1- enviada pelo artista
                        ])
                        ->orderBy('updated_at', 'DESC')
                        ->orderBy('created_at', 'DESC')
                        ->get();
                }

                $view->with('notificacoes', $notificacoes);
            }



        });
    }
}
