@extends('layouts.index')

@section('container')
    @foreach($solicitacoes as $solicitacao)
        <div class="card">
            <div class="card-body">
{{--                <h3 class="card-title">{{ $artista->nome}}</a></h3>--}}
{{--                <p>{{ $artista->nome }} toca {{ $artista->genero }}!</p>--}}
{{--                <p>{{ $artista->quantidade_membros}} membro(s) </p>--}}
{{--                <p><a href="{{ $artista->link}}" target="_blank">Ouça</a></p>--}}
{{--                <button class="btn btn-primary" id="convidar" onclick="preencherEventos({{ $artista->id }})" data-toggle="modal" data-target="#exampleModal">Convidar</button>--}}
            </div>
        </div>
    @endforeach
@endsection
