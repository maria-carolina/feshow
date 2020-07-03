<?php

namespace App\Http\Controllers;

use App\Artista;
use App\Genero;
use App\User;
use App\Endereco;
use App\ArtistasGenero;
use App\EspacosGenero;
use App\ArtistasEvento;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class ArtistaController extends Controller
{
    //


    public function insert(Request $request){
        $artista = new Artista();
        $user = new User();


        $user->name = $request->txtLogin;
        $user->email = $request->txtEmail;
        $user->password = Hash::make($request->txtSenha);
        $user->tipo_usuario = $request->txtTipo;
        if($user->save()){
            $artista->nome = $request->txtNome;
            $artista->quantidade_membros = $request->txtQtd;
            $artista->telefone = $request->txtTelefone;
            $artista->cep = $request->txtCep;
            $artista->cidade = $request->txtCidade;
            $artista->link = $request->txtLink;
            $artista->user_id = $user->id;

            if($artista->save()){
                if($request->cmbGenero_1 > 0){
                    $artista_genero = new ArtistasGenero();
                    $artista_genero->artista_id = $artista->id;
                    $artista_genero->genero_id = $request->cmbGenero_1;
                    $artista_genero->save();
                }

                if($request->cmbGenero_2 > 0){
                    $artista_genero = new ArtistasGenero();
                    $artista_genero->artista_id = $artista->id;
                    $artista_genero->genero_id = $request->cmbGenero_2;
                    $artista_genero->save();
                }

                if($request->cmbGenero_3 > 0){
                    $artista_genero = new ArtistasGenero();
                    $artista_genero->artista_id = $artista->id;
                    $artista_genero->genero_id = $request->cmbGenero_3;
                    $artista_genero->save();
                }
            }
        }
        Auth::login($user);

        return redirect()->route('home');
    }

    public function update(Request $request, $id){
        $artista = Artista::findOrFail($id);
        $user = User::findorFail($artista->user_id);
        $user->email = $request->txtEmail;
        $user->name = $request->txtLogin;

        if($user->save()){
            $artista->nome = $request->txtNome;
            $artista->quantidade_membros = $request->txtQtd;
            $artista->telefone = $request->txtTelefone;
            $artista->cep = $request->txtCep;
            $artista->cidade = $request->txtCidade;
            $artista->link = $request->txtLink;

            if($artista->save()){
                if($request->cmbGenero_1 > 0){
                    $artista_genero = ArtistasGenero::where([['artista_id', $artista->id],
                        ['genero_id', $request->cmbGenero_1]])->first();

                    if(!$artista_genero){
                        $artista_genero = new ArtistasGenero();
                        $artista_genero->artista_id = $artista->id;
                        $artista_genero->genero_id = $request->cmbGenero_1;
                        $artista_genero->save();
                    }
                }

                if($request->cmbGenero_2 > 0){
                    $artista_genero = ArtistasGenero::where([['artista_id', $artista->id],
                        ['genero_id', $request->cmbGenero_2]])->first();

                    if(!$artista_genero){
                        $artista_genero = new ArtistasGenero();
                        $artista_genero->artista_id = $artista->id;
                        $artista_genero->genero_id = $request->cmbGenero_2;
                        $artista_genero->save();
                    }
                }

                if($request->cmbGenero_3 > 0){
                    $artista_genero = ArtistasGenero::where([['artista_id', $artista->id],
                        ['genero_id', $request->cmbGenero_3]])->first();

                    if(!$artista_genero){
                        $artista_genero = new ArtistasGenero();
                        $artista_genero->artista_id = $artista->id;
                        $artista_genero->genero_id = $request->cmbGenero_3;
                        $artista_genero->save();
                    }
                }
            }
        }
        return redirect()->route('home');

    }

    public function logar(Request $request){
        $artistas = Artista::all();
        foreach($artistas as $artista){
            if(($artista->login == $request->txtLogin && $artista->email == $request->txtLogin)
                || $artista->senha == $request->txtSenha){
                return view('perfilArtista', compact('artista'));
            }
        }
        $erro = true;

        return view('login', compact('erro'));
    }

    public function abrirCadastro(){
        $generos = Genero::all();
        return view('artista.cadastroArtista', compact('generos'));
    }

    public function abrirPerfil($id){
        $artista = Artista::findOrFail($id);
        $eventos = ArtistasEvento::where('artista_id', $id)
            ->where('resposta', 2)
            ->join('eventos', 'eventos.id', 'artistas_eventos.evento_id')
            ->join('espacos', 'espacos.id', 'eventos.espaco_id')
            ->where('eventos.status', 1)
            ->select('eventos.*', 'espacos.nome as espaco')
            ->get();

        $generos = ArtistasGenero::where('artista_id', $id)
            ->join('generos', 'generos.id', 'artistas_generos.genero_id')
            ->select('generos.nome as nome')
            ->get();

        return view('artista.perfil', compact('artista', 'eventos', 'generos'));

    }

    public function abrirEdicao($id){
        $artista = Artista::findOrFail($id);
        $artista['user'] = User::findOrFail($artista->user_id);

        $artista['generos'] = ArtistasGenero::where('artista_id', $id)
            ->join('generos', 'generos.id', 'artistas_generos.genero_id')
            ->get();


        $generos = Genero::all();

        return view('artista.cadastroArtista', compact('artista', 'generos'));

    }

    public function abrirConvites($id){
        $convites = ArtistasEvento::where('artista_id', $id)
            ->where('artistas_eventos.resposta', '<', 2)
            ->join('eventos', 'artistas_eventos.evento_id', 'eventos.id')
            ->join('espacos', 'eventos.espaco_id', 'espacos.id')
            ->select('artistas_eventos.evento_id as evento_id', 'artistas_eventos.resposta as resp',
                'espacos.id as espaco_id','eventos.nome as evento', 'espacos.nome as espaco')
            ->get();

        $convites_recebidos = array();
        $convites_enviados = array();

        foreach($convites as $convite){
            if($convite->resp == 1){
                array_push($convites_recebidos,  $convite);
            }else{
                array_push($convites_enviados, $convite);
            }
        }

        $artista_id = $id;

        return view('artista.convites',
        compact('convites_recebidos', 'convites_enviados', 'artista_id'));
    }



    public function abrirFeed($id){
        $artista = Artista::findOrFail($id);
        $artista_id = $id;

        $rs = Endereco::where('cidade', $artista->cidade)
            ->join('espacos', 'enderecos.espaco_id', 'espacos.id')
            ->leftjoin('eventos', 'eventos.espaco_id', 'espacos.id')
            ->where('eventos.status', 0)
            ->select('eventos.nome as evento', 'eventos.id as evento_id', 'eventos.*',
                'espacos.nome as espaco', 'espacos.id as espaco_id')
            ->get();



        $gens = ArtistasGenero::where('artista_id', $artista->id)
            ->join('generos', 'generos.id', 'artistas_generos.genero_id')
            ->select('generos.id as genero_id', 'generos.nome as genero')
            ->get();



        foreach($rs as $key => $evento){
            $espaco_generos = EspacosGenero::where('espaco_id', $evento->espaco_id)->get();
            //dd($espaco_generos);
            foreach($espaco_generos as $linha){
                foreach($gens as $gen){
                    if($gen->genero_id == $linha->genero_id){

                        $convite = ArtistasEvento::where([['artista_id', $artista_id],
                                ['evento_id', $evento->evento_id]])->first();
                        if($convite){
                            $evento['convite'] = $convite->resposta;
                        }
                        $feed[$key] = $evento;
                    }

                }
            }
        }
        if (!isset($feed)){
            return view('artista.feed', compact( 'artista_id'));
        }
        else{
            return view('artista.feed', compact('feed', 'artista_id'));
        }
    }

    public function abrirEventos($id){
        $artista_id = $id;
        $eventos = ArtistasEvento::where([['artista_id', $id], ['resposta', 2]])
            ->join('eventos', 'eventos.id', 'artistas_eventos.evento_id')
            ->where('eventos.status', 0)
            ->join('espacos', 'espacos.id', 'eventos.espaco_id')
            ->select('eventos.*', 'espacos.id as espaco_id', 'espacos.nome as espaco')
            ->get();

        return view('artista.eventos', compact('eventos', 'artista_id'));

    }

}
