<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Response;
use App\Evento;
use App\Artista;
use App\Espaco;
use App\ArtistasEvento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventoController extends Controller
{
    public function insert(Request $request){
//        $this->validate($request, [
//            // para verificar inicio nao é maior que fim
//            'txtDataInicio' => 'required|date|after_or_equal:txtDataFim'
//        ]);

        $evento = new Evento();

        $evento->nome = $request->txtNome;
        $evento->descricao = $request->txtDescricao;
        $evento->hora_inicio = $request->txtHorarioInicio;
        $evento->hora_fim = $request->txtHorarioFim;
        $evento->data_inicio = $request->txtDataInicio;
        $evento->data_fim = $request->txtDataFim;
        $evento->espaco_id = Espaco::where('user_id', Auth::user()->id)->first()->id; ///QND TIVER LOGIN, MUDAR PRO ID DO ESPAÇO LOGADO
        $evento->save();
        $idUser =  Auth::user()->id;
        return redirect()->route('agenda', $idUser);
    }

    public function abrirCadastro($data){

        $espaco = Espaco::where('user_id', Auth::user()->id)->first();
        $data = date('d/m/Y', strtotime($data));
        return view('evento.cadastroEvento', compact('espaco', 'data'));
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

    public function agenda($id){
        $espaco = Espaco::where('user_id', $id)->first();

        return view('evento.agenda', compact('espaco'));
    }
}
