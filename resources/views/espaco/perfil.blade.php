@extends('layouts.index')

@section('container')

<div id="perfil">
        <ul id="nome_generos">
            <li><h1> {{ $espaco->nome }} </h1></li>
            <li><h2 id="cinza">
                @foreach($generos as $genero)
                    {{ $genero->nome }}
                @endforeach
            </h2></li>
        </ul>

        <ul id="outras_infos">
            <li> {{ $endereco->logradouro }} , {{ $endereco->numero }}</li>
            <li>{{ $endereco->bairro }} </li>
            <li>{{ $endereco->cidade }}</li>

        </ul>

        @if(Auth::user()->tipo_usuario == 1)
            <a href="{{route('agenda', $espaco->user_id)}}">Visualizar agenda</a>
        @endif

        <p>
            descrição aqui
        </p>

        <h2>Histórico de Shows</h2>
        <table class="table table-bordered">

            <tr>
                <th> Evento </th>
                <th> Artistas </th>
                <th> Data </th>
            </tr>
            @foreach($eventos as $evento)
                @if($evento->data_inicio < date('Y-m-d'))
                    <tr>
                        <td> <a href="http://localhost:8000/evento/"{{ $evento->id }}>{{ $evento->nome }} </a></td>
                        <td>
                            @foreach($artistas as $artista)
                                @if($artista->evento_id == $evento->id)
                                    {{ $artista->nome }}
                                @endif
                            @endforeach
                        </td>
                        <td> {{  date('d/m/Y', strtotime($evento->data_inicio)) }} </td>
                    </tr>
                @endif
            @endforeach

        </table>

        <h2>Próximos Shows</h2>
        <table class="table table-bordered">

            <tr>
                <th> Evento </th>
                <th> Artistas </th>
                <th> Data </th>
            </tr>
            @foreach($eventos as $evento)
                @if($evento->data_inicio >= date('Y-m-d'))
                    <tr>
                        <td>  <a href="http://localhost:8000/evento/"{{ $evento->id }}>{{ $evento->nome }} </a> </td>
                        <td>
                            @foreach($artistas as $artista)
                                @if($artista->evento_id == $evento->id)
                                    {{ $artista->nome }}
                                @endif
                            @endforeach
                        </td>
                        <td> {{  date('d/m/Y', strtotime($evento->data_inicio)) }} </td>
                    </tr>
                @endif
            @endforeach


        </table>

        @if(Auth::user()->id == $espaco->user_id)
            <button><a href="{{ route('abrir_edicao_espaco', $espaco->id)}}">Editar</a></button>
        @endif
<div>

@endsection




