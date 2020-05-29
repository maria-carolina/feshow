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

    @if(Auth::user()->tipo_usuario == 1)
        <button name="btnSolPart">Solicitar partipação</button>
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

@section('scripts_adicionais')
    <script>
        var button = document.querySelector('button[name=btnSolPart]');

        button.onclick = () => {
            let idEvento = {{ $evento->id }};
            let idUser = {{ Auth::user()->id }}
            var xhr = new XMLHttpRequest();
            xhr.open('GET', `http://localhost:8000/api/acharIdArtista/${idUser}`);
            xhr.send(null);

            xhr.onreadystatechange = () => {
                if(xhr.readyState === 4){
                    let idArtista = JSON.parse(xhr.responseText).id;
                    console.log(idArtista);
                    var xhr2 = new XMLHttpRequest();
                    xhr2.open('GET', `http://localhost:8000/api/enviarconvite/${idEvento}/${idArtista}/0`);
                    xhr2.send(null);

                }
            }
        }

    </script>
@endsection
@endsection
