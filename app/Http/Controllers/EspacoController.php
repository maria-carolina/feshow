<?php

namespace App\Http\Controllers;

use App\Artista;
use App\Espaco;
use App\EspacosGenero;
use App\Endereco;
use App\Genero;
use App\User;
use Illuminate\Http\Request;

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

       // $generos_id = EspacoGenero::where('casa_id', $casa->id)->get('genero_id');
        //$generos = array();

        /*foreach ($generos_id as $genero_id){
            array_push($generos, Genero::findorFail($genero_id));
        }*/

        return view('espaco.perfil', compact('espaco' , 'endereco'));

    }

}
