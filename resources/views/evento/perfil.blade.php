@extends('layouts.index')

@section('container')

<div id="perfil">
@if(isset($evento))
    <h1>{{ $evento->nome }}</h1>
    <h2 id="cinza">{{ $evento->espaco->nome}}</h2>

    <p>{{ $lineup }}</p>
    <p>{{ $evento->descricao}}</p>
    <ul id="data_horario">
        <li>{{ date('d/m/Y', strtotime($evento->data)) }} </li>
        <li>{{ date('H:i', strtotime($evento->hora_inicio)) }} - 
        {{ date('H:i', strtotime($evento->hora_fim)) }}</li>
    </ul>

    @if(Auth::user()->id == $evento->espaco->user_id)
        <button><a href="convite/{{ $evento->id }}">Convidar Artista</a></button>
    @endif
    @else
    <h1>{{ $evento->nome }}</h1>
    <h2>{{ $evento->espaco->nome}}</h2>

    <p>{{ $lineup }}</p>
    <p>{{ $evento->descricao}}</p>
    <ul id="data_horario">
        <li>{{ $evento->data }} </li>
        <li>{{ $evento->horario_inicio }} - {{ $evento->horario_fim }} </li>
    </ul>

      @endif
<div>


@endsection
