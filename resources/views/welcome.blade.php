<?php
use App\Artista;
use App\Espaco;

?>

@extends('layouts.base')

@section('links_adicionais')
    <style type="text/css">
        a:link{
            text-decoration:none;
            color:purple;
        }

        a:visited{
            text-decoration:none;
            color:purple;
        }

        a:hover{
            text-decoration:none;
            color:purple;
        }

        a:active{
            text-decoration:none;
            color:purple;
        }

        h4{
            color: purple;
        }

    </style>
@endsection

@section('body')
    <body class="index-page sidebar-collapse">

    <nav class="navbar navbar-transparent navbar-color-on-scroll fixed-top navbar-expand-lg" color-on-scroll="100" id="sectionsNav">
        <div class="container">
            <div class="navbar-translate">
                <a class="navbar-brand" href="#">
                    Feshow </a>
            </div>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ml-auto">
                    {{--                <li class="dropdown nav-item">--}}
                    {{--                    <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">--}}
                    {{--                        <i class="material-icons">apps</i> Components--}}
                    {{--                    </a>--}}
                    {{--                    <div class="dropdown-menu dropdown-with-icons">--}}
                    {{--                        <a href="./index.html" class="dropdown-item">--}}
                    {{--                            <i class="material-icons">layers</i> All Components--}}
                    {{--                        </a>--}}
                    {{--                        <a href="https://demos.creative-tim.com/material-kit/docs/2.0/getting-started/introduction.html" class="dropdown-item">--}}
                    {{--                            <i class="material-icons">content_paste</i> Documentation--}}
                    {{--                        </a>--}}
                    {{--                    </div>--}}
                    {{--                </li>--}}
                    @if(isset(Auth::user()->id))
                        <li class="nav-item">
                            @if(Auth::user()->tipo_usuario == 1)
                                <a class="nav-link" href="{{route('perfil_artista', Artista::where('user_id', Auth::user()->id)->first()->id)}}" >
                                    Área do artista <i class="fa fa-home"></i>
                                </a>
                            @else
                                <a class="nav-link" href="{{route('perfil_artista', Espaco::where('user_id', Auth::user()->id)->first()->id)}}" >
                                    Área do espaço <i class="fa fa-home"></i>
                                </a>
                            @endif
                        </li>
                    @else
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-toggle="modal" data-target="#modalLogin"> Entrar <i class="fa fa-sign-in"></i>
                        </a>
                    </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    @if(!empty($mensagem))
        <div class="alert alert-success">
            {{ $mensagem }}
        </div>
    @endif

    <div class="page-header header-filter clear-filter purple-filter" data-parallax="true">
        <div class="container">
            <div class="row">
                <div class="col-md-8 ml-auto mr-auto">
                    <div class="brand">
                        <h1>Feshow</h1>
                        <h3>Área inicial</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="main main-raised">
        <div class="section section-basic">
            <div class="container">
                Espaço pra visualização do visitante
            </div>
        </div>
    </div>


{{--    INICIO MODAL LOGIN--}}
    <div class="modal" id="modalLogin" tabindex="-1" role="dialog" data-backdrop="static">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"> </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="col offset-md-3 mb-3">
                    <h4>Acesse sua conta</h4>
                </div>
                <div class="modal-body">
                        <div class="card-body">
                            <form method="POST" action="{{ route('login') }}">
                                @csrf

                                <div class="form-group row">
                                    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Usuário') }}</label>

                                    <div class="col-md-6">
                                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autofocus>

                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Senha') }}</label>

                                    <div class="col-md-6">
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-md-8 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Entrar') }}
                                        </button>

{{--                                        @if (Route::has('password.request'))--}}
{{--                                            <a class="btn btn-link" href="{{ route('password.request') }}">--}}
{{--                                                {{ __('Forgot Your Password?') }}--}}
{{--                                            </a>--}}
{{--                                        @endif--}}
                                    </div>
                                    <div class="col offset-md-3">
                                        <br>
                                        <a href="#" data-dismiss="modal"  data-toggle="modal" data-target="#modalCadastro">Não possuo cadastro</a>
                                    </div>
                                    </div>
                            </form>
                        </div>
                </div>

            </div>
        </div>
    </div>
    {{--    FIM MODAL LOGIN--}}

{{--    MODAL CADASTRO--}}
    <div class="modal" id="modalCadastro" tabindex="-1" role="dialog" data-backdrop="static">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"> </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="col offset-3 mb-5">
                    <h4>Cadastrar conta como</h4>
                </div>
                <div class="modal-body">
                   <div class="row">
                       <div class="col offset-md-4 mb-3">
                           <a href="{{route('cadastro_artista')}}" class="btn btn-primary btn-lg">Artista</a>
                       </div>
                       <div class="col offset-md-4 mb-3">
                           <a href="{{route('cadastro_casa')}}" class="btn btn-primary btn-lg">Espaço</a>
                       </div>
                   </div>
                </div>

            </div>
        </div>
    </div>
{{--    FIM MODAL CADASTRO--}}

    </body>
@endsection
