@extends('layouts.base')

@section('body')
    <nav class="navbar navbar-expand-lg bg-primary fixed-top">
        <div class="container">
            <div class="navbar-translate">
                <a class="navbar-brand" href="{{route('inicio')}}">FESHOW</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="navbar-toggler-icon"></span>
                    <span class="navbar-toggler-icon"></span>
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
            @if(isset(Auth::user()->id))
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ml-auto">
                    <li class="active nav-item">
                        <a href="#" class="nav-link">
                            <i class="material-icons"></i>
                            Discover
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="material-icons"></i>
                            Profile
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            {{ __('Sair') }} <i class="fa fa-sign-out"></i>
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
        @yield('container')
    </div>

@endsection

