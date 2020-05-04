<?php

namespace App\Http\Controllers;

use App\Evento;
use App\ArtistasEvento;
use Illuminate\Http\Request;

class EventoController extends Controller
{
    public function insert(Request $request){
        $evento = new Evento();

        $evento->nome = $request->txtNome;
        $evento->descricao = $request->txtDescricao;
        $evento->hora_inicio = $request->txtHorarioInicio;
        $evento->hora_fim = $request->txtHorarioFim;
        $evento->data = $request->txtData;
        $evento->espaco_id = 1; ///QND TIVER LOGIN, MUDAR PRO ID DO ESPAÇO LOGADO   

        $evento->save();

    }

    public function abrirCadastro(){
        return view('evento.cadastroEvento');
    }

    public function abrirPerfil($id){
        $evento = Evento::findOrFail($id);
        $artistas = ['dj etc', 'vavá', 'dj belinha'];
        $lineup = "Line-up: ";

        foreach($artistas as $artista){
            if(strcmp($artista, $artistas[0]) == 0){///VAI PRECISAR MUDAR ESSA COMPARAÇÃO
                $lineup = $lineup.$artista;
            }else{
                $lineup = $lineup.", ".$artista;
            }
        }

        return view('evento.perfil', compact('evento', 'lineup'));

    }

    public function abrirConvite($id){
        $evento = Evento::findOrFail($id);
        return view('evento.conviteArtista', compact('evento'));
    }
}
