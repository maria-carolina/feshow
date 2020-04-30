<?php

namespace App\Http\Controllers;

use App\Artista;
use App\Genero;
use App\User;
use App\ArtistasGenero;

use Illuminate\Http\Request;

class ArtistaController extends Controller
{
    //

    public function insert(Request $request){
        $artista = new Artista();
        $user = new User();
        

        $user->name = $request->txtLogin;
        $user->email = $request->txtEmail;
        $user->password = $request->txtSenha;
        $user->tipo_usuario = $request->txtTipo;
        if($user->save()){
            $artista->nome = $request->txtNome;
            $artista->quantidade_membros = $request->txtQtd;
            $artista->telefone = $request->txtTelefone;
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

        

        return view ('welcome');
    }

    public function update(Request $request, $id){
        $artista = Artista::findOrFail($id);
        $artista->nome = $request->txtNome;
        $artista->email = $request->txtEmail;
        $artista->quantidade_membros = $request->txtQtd;
        $artista->telefone = $request->txtTelefone;
        $artista->cidade = $request->txtCidade;
        $artista->link = $request->txtLink;
        $artista->genero_id = $request->cmbGenero;

        $artista->save();

        return view ('welcome');

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
        $generoController = new GeneroController();
        $generos = $generoController->buscarTodos();
        return view('artista.cadastroArtista', compact('generos'));
    }

    public function abrirPerfil($id){
        $artista = Artista::findOrFail($id);
        //$genero = Genero::findorFail($artista->genero_id);

        return view('artista.perfil', compact('artista'));

    }

    public function abrirEdicao($id){
        $artista = Artista::findOrFail($id);
        $generoController = new GeneroController();
        $generos = $generoController->buscarTodos();
        return view('artista.cadastroArtista', compact('artista','generos'));

    }


}
