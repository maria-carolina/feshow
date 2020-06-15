@extends('layouts.index')

@section('container')

<div id="perfil">

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
    É tido como um dos músicos eletrônicos mais importantes e inovadores de sua geração,
     reverenciado por artistas que vão da música eletrônica ao rock.
     Foi considerado pelo jornal inglês The Guardian como "a mais influente e criativa figura da música eletrônica contemporânea".
    </p>
    <ul id="outras_infos">
        <li>{{ $artista->quantidade_membros }} membro(s)</li>
        <li>{{ $artista->telefone }} </li>
        <li>{{ $artista->cidade }}</li>
        @if(isset($genero))
        <li>Genero: {{ $genero->nome }}</li>
        @endif
    </ul>
    <h2>Histórico de Shows</h2>
    <table class="table table-bordered">
        <tr>
            <th> Espaço </th>
            <th> Evento </th>
            <th> Data </th>
        </tr>
        @foreach($eventos as $evento)
            @if($evento->data < date('Y-m-d'))
                <tr>
                    <td> {{ $evento->espaco }} </td>
                    <td> <a href="http://localhost:8000/evento/{{ $evento->id }}">{{ $evento->nome}}</a> </td>
                    <td> {{ date('d/m/Y', strtotime($evento->data)) }} </td>
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
            @if($evento->data < date('Y-m-d'))
                <tr>
                    <td> {{ $evento->espaco }} </td>
                    <td><a href="http://localhost:8000/evento/{{ $evento->id }}">{{ $evento->nome}}</a> </td>
                    <td> {{ date('d/m/Y', strtotime($evento->data)) }} </td>
                </tr>
            @endif
        @endforeach
        
    </table>
    @if(Auth::user()->id == $artista->user_id)
        <button><a href="{{ route('abrir_edicao', $artista->id)}}">Editar</a></button>
    @endif

   
<div>
@endsection




