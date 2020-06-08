@extends('layouts.index')

@section('container')

@if(isset($feed))
    <div id="feed">
        <h2>Sugestões</h2>
        @foreach($feed as $artista)
            <div class="card">
                <div class="card-body">
                <h3 class="card-title"><a href="artista/perfil/{{ $artista->id }}">{{ $artista->nome}}</a></h3>
                <p>{{ $artista->nome }} toca {{ $artista->genero }}!</p>
                <p>{{ $artista->quantidade_membros}} membro(s) </p>
                <p><a href="{{ $artista->link}}" target="_blank">Ouça</a></p>
                <button class="btn btn-primary" id="convidar">Convidar</button>
                </div>
            </div>
        @endforeach
    <div>
@endif

@endsection