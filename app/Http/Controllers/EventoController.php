<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Response;
use App\Evento;
use App\Artista;
use App\Espaco;
use App\Solicitacao;
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
        $evento->status = 0;
        $evento->espaco_id = Espaco::where('user_id', Auth::user()->id)->first()->id; ///QND TIVER LOGIN, MUDAR PRO ID DO ESPAÇO LOGADO
        $evento->save();
        $idEvento = $evento->id;

        return redirect()->route('convidar_artista', $idEvento);
    }

    public function update(Request $request, $id){
        $evento = Evento::findOrFail($id);
        $evento->nome = $request->txtNome;
        $evento->descricao = $request->txtDescricao;
        $evento->data_inicio = $request->txtDataInicio;
        $evento->data_fim = $request->txtDataFim;
        $evento->hora_inicio = $request->txtHorarioInicio;
        $evento->hora_fim = $request->txtHorarioFim;

        $evento->save();
        return view('welcome');
    }

    public function abrirCadastro(){
        $espaco = Espaco::where('user_id', Auth::user()->id)->first();
        return view('evento.cadastroEvento', compact('espaco'));
    }

    public function abrirCadastroData(Request $request){
        $espaco = Espaco::where('user_id', Auth::user()->id)->first();
        $data = date('Y-m-d', strtotime($request->data));
        return view('evento.cadastroEvento', compact('espaco', 'data'));
    }

    public function abrirEdicao(Request $request, $id){
        $evento = Evento::findOrFail($id);
        $espaco = Espaco::findOrFail($evento->espaco_id);


        return view('evento.cadastroEvento', compact('evento', 'espaco'));
    }

    public function abrirPerfil($id){
        $evento = Evento::findOrFail($id);
        $rs = Evento::where('eventos.id', $id)
        ->join('artistas_eventos', 'artistas_eventos.evento_id', 'eventos.id')
            ->where('artistas_eventos.resposta', '2')
        ->join('artistas','artistas_eventos.artista_id', 'artistas.id')
        ->select('artistas.nome as artista', 'artistas.id as artista_id')
        ->get();

        $user = Auth::user();


        if($user->tipo_usuario == 1){
            $logado = Artista::where('user_id', $user->id)->first();
            $convite = ArtistasEvento::where([['artista_id', $logado->id],
            ['evento_id', $id]])->first();

            if($convite){
                $evento['convite'] = $convite->resposta;
            }
        }else{
            $logado = Espaco::where('user_id', $user->id)->first();
        }


        return view('evento.perfil', compact('evento', 'rs', 'logado'));
    }

    public function abrirConvite($id){
        $evento = Evento::findOrFail($id);
        return view('evento.conviteArtista', compact('evento'));
    }

    public function agenda($id){
        $espaco = Espaco::where('user_id', $id)->first();
        return view('evento.agenda', compact('espaco'));
    }

    public function solicitarEvento($idArtista, $idEspaco, Request $request){

       $solicitacao = new Solicitacao();
       $solicitacao->artista_id = Artista::where('user_id', $idArtista)->first()->id;
       $solicitacao->espaco_id =$idEspaco;
       $solicitacao->data = $request->dataSolicitada;;
       $solicitacao->resposta = 1; //enviada pelo artista
       $solicitacao->save();

       $espaco = Espaco::findOrFail($idEspaco);
       return view('evento.agenda', compact('espaco'));
    }

    public function abrirCadastroSolicitado($idArtista, $idSolicitacao){
        $espaco = Espaco::where('user_id', Auth::user()->id)->first();
        $artista = Artista::findOrFail($idArtista);
        $solicitacao = Solicitacao::findOrFail($idSolicitacao);
        return view('evento.cadastroEvento', compact('espaco', 'artista', 'solicitacao'));
    }

    public function insertEventoSolicitado($idSolicitacao, Request $request){
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
            $evento->status = 0;
            $evento->espaco_id = Espaco::where('user_id', Auth::user()->id)->first()->id; ///QND TIVER LOGIN, MUDAR PRO ID DO ESPAÇO LOGADO
            $evento->save();
            $idEvento = $evento->id;


            $solicitacao = Solicitacao::findOrFail($idSolicitacao);
            $solicitacao->resposta = 2; //solicitacao aceita
            $solicitacao->save();


            $artistaevento = new ArtistasEvento();
            $artistaevento->evento_id = $idEvento;
            $artistaevento->artista_id = $solicitacao->artista_id;
            $artistaevento->resposta = 1; //1-aguardando resposta do artista
            $artistaevento->save();


            return redirect()->route('abrir_perfil', $idEvento);
        }

    public function deleteEventoSolicitado($idSolicitacao){

        $solicitacao = Solicitacao::findOrFail($idSolicitacao);
        $solicitacao->delete();
        return redirect()->route('solicitacao_espaco');
    }
}
