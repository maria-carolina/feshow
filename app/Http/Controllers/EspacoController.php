<?php

namespace App\Http\Controllers;

use App\Artista;
use App\Espaco;
use App\CasaGenero;
use App\Endereco;
use App\Genero;
use App\User;
use Illuminate\Http\Request;

class EspacoController extends Controller
{
    //

    public function insert(Request $request){
        $endereco = new Endereco();
        $espaco = new Espaco();
        $espacoGenero = new CasaGenero();
        $user = new User();

        $user->name = $request->txtLogin;
        $user->email = $request->txtEmail;
        $user->password = $request->txtSenha;
        $user->tipo_usuario = $request->txtTipo;

        if($user->save()) {
            $espaco->user_id = $user->id;
            $espaco->nome = $request->txtNome;
            $espaco->telefone = $request->txtTelefone;

            if ($espaco->save()) {
                //$casaGenero->casa_id = $casa->id;
                //$casaGenero->genero_id = $request->cmbGenero;
                //$casaGenero->save();
                $endereco->espaco_id = $espaco->id;
                $endereco->logradouro = $request->txtLogradouro;
                $endereco->bairro = $request->txtBairro;
                $endereco->cidade = $request->txtCidade;
                $endereco->cep = $request->txtCep;
                $endereco->numero = $request->txtNum;
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
        $espaco = Espaco::findOrFail($id);
        $endereco = Endereco::where('espaco_id','=', $id)->first();
        
       // $generos_id = EspacoGenero::where('casa_id', $casa->id)->get('genero_id');
        //$generos = array();

        /*foreach ($generos_id as $genero_id){
            array_push($generos, Genero::findorFail($genero_id));
        }*/

        return view('perfil', compact('espaco' , 'endereco'));

    }

}
