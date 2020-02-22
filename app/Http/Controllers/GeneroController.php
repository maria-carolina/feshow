<?php

namespace App\Http\Controllers;

use App\Genero;
use Illuminate\Http\Request;

class GeneroController extends Controller
{
    //

    public function buscarTodos(){
        $obj = new Genero();
        return $obj::all();
    }
}
