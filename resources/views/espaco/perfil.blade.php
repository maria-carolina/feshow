@extends('layouts.index')

@section('container')

<div id="perfil">
@if(isset($artista))
    <ul id="nome_generos">
    <li><h1> {{ $artista->nome }} </h1></li>
    <li><h2 id="generos"> idm, glitch, experimental</h2></li>
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
        <tr>
            <td> Bar do zé </td>
            <td> diego freitas no bar do zé </td>
            <td> 21/09/2019 </td>
        </tr>
        <tr>
            <td> Sei lá club </td>
            <td> festival sei lá </td>
            <td> 10/08/2019 </td>
        </tr>
        <tr>
            <td> Estúdio Tal </td>
            <td> Tal Gig </td>
            <td> 09/07/2019 </td>
        </tr>
    </table>

    <button><a href="{{ route('abrir_edicao', $artista->id)}}">Editar</a></button>
    @else
        <ul id="nome_generos">
            <li><h1> {{ $espaco->nome }} </h1></li>
            <li><h2 id="generos"> idm, glitch, experimental</h2></li>
        </ul>

        <ul id="outras_infos">
            <li> {{ $endereco->logradouro }} , {{ $endereco->numero }}</li>
            <li>{{ $endereco->bairro }} </li>
            <li>{{ $endereco->cidade }}</li>
            @if(isset($genero))
            <li>Genero: {{ $genero->nome }}</li>
            @endif
        </ul>

        <p>
        É tido como um dos músicos eletrônicos mais importantes e inovadores de sua geração,
        reverenciado por artistas que vão da música eletrônica ao rock. 
        Foi considerado pelo jornal inglês The Guardian como "a mais influente e criativa figura da música eletrônica contemporânea".
        </p>
        
        <h2>Histórico de Shows</h2>
        <table class="table table-bordered">
            <tr>
                <th> Evento </th>
                <th> Artistas </th>
                <th> Data </th>
            </tr>
            <tr>
                <td> diego freitas no bar do zé </td>
                <td> diego freitas </td>
                <td> 21/09/2019 </td>
            </tr>
            <tr>
                <td> dj maria no bar do zé </td>
                <td> dj maria </td>
                <td> 10/08/2019 </td>
            </tr>
            
        </table>

      @endif
<div>
@endsection




