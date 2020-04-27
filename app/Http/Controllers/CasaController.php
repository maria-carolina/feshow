<?php

namespace App\Http\Controllers;

use App\Artista;
use App\Casa;
use App\CasaGenero;
use App\Endereco;
use App\Genero;
use App\User;
use Illuminate\Http\Request;

class CasaController extends Controller
{
    //

    public function insert(Request $request){
        $endereco = new Endereco();
        $casa = new Casa();
        $casaGenero = new CasaGenero();
        $user = new User();

        $user->name = $request->txtLogin;
        $user->email = $request->txtEmail;
        $user->password = $request->txtSenha;

        if($user->save()) {
            $casa->user_id = $user->id;
            $casa->nome = $request->txtNome;
            $casa->telefone = $request->txtTelefone;

            if ($casa->save()) {
                $casaGenero->casa_id = $casa->id;
                $casaGenero->genero_id = $request->cmbGenero;
                $casaGenero->save();


                $endereco->casa_id = $casa->id;
                $endereco->logradouro = $request->txtLogradouro;
                $endereco->bairro = $request->txtBairro;
                $endereco->cidade = $request->txtCidade;
                $endereco->cep = $request->txtCep;
                $endereco->uf = $request->cmbUf;
                $endereco->save();
            }
        }

        return view ('welcome');

    }

    public function abrirCadastro(){
        $generoController = new GeneroController();
        $generos = $generoController->buscarTodos();
        return view('cadastroCasa', compact('generos'));
    }

    public function abrirPerfil($id){
        $casa = Casa::findOrFail($id);

        $generos_id = CasaGenero::where('casa_id', $casa->id)->get('genero_id');
        $generos = array();

        foreach ($generos_id as $genero_id){
            array_push($generos, Genero::findorFail($genero_id));
        }

        return view('perfil', compact('casa', 'generos'));

    }

}
