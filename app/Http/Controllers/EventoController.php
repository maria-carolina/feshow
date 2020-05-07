<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Response;
use App\Evento;
use App\Artista;
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
        $rs = Artista::where('eventos.id', $id)
        ->join('artistas_eventos', 'artistas.id', '=', 'artistas_eventos.artista_id')
        ->join('eventos', 'eventos.id', '=', 'artistas_eventos.artista_id')
        ->select('artistas.nome')
        ->get();

        $lineup = "Lineup: ";
        
        foreach( $rs as $linha){
            if($linha === $rs[0]){
                $lineup = $lineup.' '.$linha->nome;
            }else{
                $lineup = $lineup.', '.$linha->nome;
            }
        }
        return view('evento.perfil', compact('evento', 'lineup'));

    }

    public function abrirConvite($id){
        $evento = Evento::findOrFail($id);
        return view('evento.conviteArtista', compact('evento'));
    }
}
