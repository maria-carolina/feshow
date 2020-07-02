<?php
use App\Artista;
use App\Espaco;
?>

@extends('layouts.base')

@section('body')
    <nav class="navbar navbar-expand-lg bg-dark fixed-top">
        <div class="container">
            <div class="navbar-translate">
                <a id="feshow" class="navbar-brand" href="{{route('home')}}">FESHOW</a>
            </div>

            @if(isset(Auth::user()->id))
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ml-auto">

                    @if(Auth::user()->tipo_usuario == 0)
                        {{--  ESPAÇO--}}

                        <li class="nav-item mr-2">
                            <a href="#" class="btn btn-primary btn-fab btn-round">
                                <i class="fa fa-bell-o" title="Notificações"></i>
                            </a>
                        </li>

                        <li class="nav-item mr-2">
                            <a href="{{route('solicitacao_espaco')}}" class="btn btn-primary btn-fab btn-round">
                                <i class="fa fa-envelope" title="Solicitações"></i>
                            </a>
                        </li>

                        <li class="nav-item mr-2">
                            <a href="{{route('agenda', Auth::user()->id)}}" class="btn btn-primary btn-fab btn-round">
                                <i class="fa fa-calendar" title="Agenda"></i>
                            </a>
                        </li>

                        <li class="nav-item mr-2">
                            <a href="{{route('perfil_espaco',
                                     Espaco::where('user_id', Auth::user()->id)->first()->id)}}" class="btn btn-primary btn-fab btn-round">
                                <i class="fa fa-user-circle" title="Perfil"></i>
                            </a>
                        </li>
                    @else
                        {{--    ARTISTA    </li>--}}
                        <li class="nav-item mr-2">
                            <a href="#" class="btn btn-primary btn-fab btn-round">
                                <i class="fa fa-bell-o" title="Notificações"></i>
                            </a>
                        </li>

                        <li class="nav-item mr-2">
                            <a href="#" class="btn btn-primary btn-fab btn-round">
                                <i class="fa fa-envelope" title="Solicitações"></i>
                            </a>
                        </li>

                        <li class="nav-item mr-2">
                            <a href="{{route('perfil_artista',
                                      Artista::where('user_id', Auth::user()->id)->first()->id)}}" class="btn btn-primary btn-fab btn-round">
                                <i class="fa fa-user-circle" title="Perfil"></i>
                            </a>
                        </li>
                    @endif

                    <li class="nav-item">
                        <a class="btn btn-primary btn-fab btn-round" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            <i class="fa fa-sign-out" title="Sair"></i>
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>

            @endif
        </div>
    </nav>

    <div class="container mt-5">
        <br>
        @includeIf('layouts.erros')
        @yield('container')

    </div>

    @yield('modal')

@endsection

