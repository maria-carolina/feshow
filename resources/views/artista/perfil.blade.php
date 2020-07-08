@extends('layouts.index')

@section('container')

<div id="perfil" class="mt-4">

    <ul id="nome_generos">
    <li><h1> {{ $artista->nome }} </h1></li>
    <li><h2 id="cinza">
        @foreach($generos as $genero)
            {{ $genero->nome }}
        @endforeach
    </h2></li>
    </ul>

    <a href="{{ $artista->link}}" id="ouvir"> Ouça </a>
    <p>
        {{ $artista->descricao }}
    </p>
    <ul id="outras_infos">
        <li>{{ $artista->quantidade_membros }} membro(s)</li>
        <li>{{ $artista->telefone }} </li>
        <li>{{ $artista->cidade }}</li>
        @if(isset($genero))
        <li>Genero: {{ $genero->nome }}</li>
        @endif
    </ul>
    @if(Auth::user()->id == $artista->user_id)
        <div class="mb-5">
            <a href="{{ route('abrir_edicao_artista', $artista->id)}}" class="btn btn-primary">Editar perfil</a>
        </div>
    @endif

    <h2>Histórico de Shows</h2>
    <table class="table table-bordered">
        <tr>
            <th> Espaço </th>
            <th> Evento </th>
            <th> Data </th>
        </tr>
        @foreach($eventos as $evento)
            @if($evento->data_inicio < date('Y-m-d'))
                <tr>
                    <td> {{ $evento->espaco }} </td>
                    <td> <a href="http://localhost:8000/evento/{{ $evento->id }}">{{ $evento->nome}}</a> </td>
                    <td> {{ date('d/m/Y', strtotime($evento->data_inicio)) }} </td>
                </tr>
            @endif
        @endforeach

    </table>

    <h2>Próximos Shows</h2>
    <table class="table table-bordered">
        <tr>
            <th> Espaço </th>
            <th> Evento </th>
            <th> Data </th>
        </tr>
        @foreach($eventos as $evento)
            @if($evento->data_inicio >= date('Y-m-d'))
                <tr>
                    <td> {{ $evento->espaco }} </td>
                    <td><a href="http://localhost:8000/evento/{{ $evento->id }}">{{ $evento->nome}}</a> </td>
                    <td> {{ date('d/m/Y', strtotime($evento->data_inicio)) }} </td>
                </tr>
            @endif
        @endforeach

    </table>

<div>
@endsection




