<?php

namespace App\Http\Controllers;

use App\Artista;
use App\Espaco;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(Auth::user()->tipo_usuario == 1){
            
            return redirect()->route('perfil_artista', 
                Artista::where('user_id', Auth::user()->id)->first()->id);
        }else{
            
            return redirect()->route('perfil_espaco', 
                Espaco::where('user_id', Auth::user()->id)->first()->id);
        }
    }
}