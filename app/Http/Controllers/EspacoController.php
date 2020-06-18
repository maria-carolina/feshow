<?php

namespace App\Http\Controllers;

use App\Artista;
use App\Espaco;
use App\Evento;
use App\EspacosGenero;
use App\Endereco;
use App\Genero;
use App\Solicitacao;
use App\User;
use App\ArtistasEvento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;


class EspacoController extends Controller
{
    //

    public function insert(Request $request){

        $this->validate($request, [
            'txtEmail'=>'required|email'
        ]);

        $endereco = new Endereco();
        $espaco = new Espaco();
        $user = new User();

        $user->name = $request->txtLogin;
        $user->email = $request->txtEmail;
        $user->password = Hash::make($request->txtSenha);
        $user->tipo_usuario = $request->txtTipo;

        if($user->save()) {
            $espaco->user_id = $user->id;
            $espaco->nome = $request->txtNome;
            $espaco->telefone = $request->txtTelefone;

            if ($espaco->save()) {
                //$casaGenero->casa_id = $casa->id;
                //$casaGenero->genero_id = $request->cmbGenero;
                //$casaGenero->save();

                if($request->cmbGenero_1 > 0){
                    $espaco_genero = new EspacosGenero();
                    $espaco_genero->espaco_id = $espaco->id;
                    $espaco_genero->genero_id = $request->cmbGenero_1;
                    $espaco_genero->save();
                }

                if($request->cmbGenero_2 > 0){
                    $espaco_genero = new EspacosGenero();
                    $espaco_genero->espaco_id = $espaco->id;
                    $espaco_genero->genero_id = $request->cmbGenero_2;
                    $espaco_genero->save();
                }

                if($request->cmbGenero_3 > 0){
                    $espaco_genero = new EspacosGenero();
                    $espaco_genero->espaco_id = $espaco->id;
                    $espaco_genero->genero_id = $request->cmbGenero_3;
                    $espaco_genero->save();
                }

                $endereco->espaco_id = $espaco->id;
                $endereco->logradouro = $request->txtLogradouro;
                $endereco->bairro = $request->txtBairro;
                $endereco->cidade = $request->txtCidade;
                $endereco->cep = $request->txtCep;
                $endereco->numero = $request->txtNum;
                $endereco->uf = $request->txtUf;
                $endereco->save();
            }
        }

        Auth::login($user);

        return view ('welcome');

    }

    public function abrirCadastro(){
        $generoController = new GeneroController();
        $generos = $generoController->buscarTodos();
        return view('espaco.cadastroCasa', compact('generos'));
    }

    public function abrirPerfil($id){
        $espaco = Espaco::findOrFail($id);
        $endereco = Endereco::where('espaco_id','=', $id)->first();
        $eventos = Evento::where('espaco_id', $id)
        ->get();
        $artistas = ArtistasEvento::where('eventos.espaco_id', $id)
        ->where('resposta', 2)
        ->join('eventos', 'eventos.id', 'artistas_eventos.evento_id')
        ->join('artistas', 'artistas.id', 'artistas_eventos.artista_id')
        ->select('artistas.nome as nome', 'eventos.id as evento_id')
        ->get();

        $generos = EspacosGenero::where('espaco_id', $id)
            ->join('generos', 'generos.id', 'espacos_generos.genero_id')
            ->select('generos.nome as nome')
            ->get();

        return view('espaco.perfil', compact('espaco', 'endereco', 'eventos', 'artistas', 'generos'));

    }

    public function abrirConvites($id){
        $convites = Evento::where('espaco_id', $id)
            ->join('artistas_eventos', 'artistas_eventos.evento_id', 'eventos.id')
              ->where('artistas_eventos.resposta', 0)
            ->join('artistas', 'artistas_eventos.artista_id', 'artistas.id')
            ->select('eventos.nome as evento', 'artistas.nome as artista',
                'artistas.id as artista_id', 'eventos.id as evento_id')
            ->get();

        $espaco_id = $id;

        //dd($convites);
        return view('espaco.convites', compact('convites', 'espaco_id'));
    }


    public function abrirFeed($id){
        $endereco = Endereco::where('espaco_id', $id)->first();
        $idEspaco = $id;

        $artistas = Artista::where('cidade', $endereco->cidade)
            ->join('artistas_generos', 'artistas_generos.artista_id', 'artistas.id')
            ->join('generos', 'generos.id', 'artistas_generos.genero_id')
            ->select('artistas.*', 'generos.nome as genero', 'generos.id as genero_id')
            ->get();

        $gens = EspacosGenero::where('espaco_id', $id)
            ->join('generos', 'generos.id', 'espacos_generos.genero_id')
            ->select('generos.id as genero_id', 'generos.nome as genero')
            ->get();

        foreach($artistas as $artista){
            foreach($gens as $gen){
                if($gen->genero_id == $artista->genero_id){
                    $feed[$artista->id] = $artista;
                }
            }
        }

        return view('espaco.feed', compact('feed', 'idEspaco'));
    }

   public function verSolicitacoes(){
        $idEspaco = Espaco::where('user_id', Auth::user()->id)->first()->id;
        $solicitacoes = Artista::join('solicitacoes', 'solicitacoes.artista_id', 'artistas.id', '')
            ->where([
               ['solicitacoes.espaco_id', $idEspaco],
               ['solicitacoes.resposta', 0]
           ])
           ->orderBy('solicitacoes.data', 'asc')
           ->get();
        return view('espaco.solicitacoes', compact('solicitacoes'));
   }


}
