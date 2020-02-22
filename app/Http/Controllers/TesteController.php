<?php

namespace App\Http\Controllers;

use App\TbTeste;
use Illuminate\Http\Request;



class TesteController extends Controller
{


    public function insert(Request $request){
        $variavel = new TbTeste();
        $variavel->coluna1 = $request->dado1;
        $variavel->coluna2 = $request->dado2;

        $variavel->save();

        return view ('welcome');
    }
}
