<?php

namespace App\Http\Controllers;

use App\Artista;
use Illuminate\Http\Request;

class ArtistaController extends Controller
{
    //

    public function insert(Request $request){
        $artista = new Artista();
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

    public function buscarGeneros(){
        $generoController = new GeneroController();
        $generos = $generoController->buscarTodos();
        return view('cadastroArtista', compact('generos'));
    }


}
