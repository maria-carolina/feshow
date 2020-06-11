@extends('layouts.index')

@section('container')

@if(isset($feed))
    <div id="feed">
        <h2>Sugestões</h2>
        @foreach($feed as $item)
            
                @if(isset($item->evento))
                <div class="card">
                    <div class="card-body">
                    <h3 class="card-title"><a href="evento/{{ $item->evento_id }}">{{ $item->evento}}</a></h3>
                    <p class="card-text">Onde? <a href="espaco/perfil/{{ $item->espaco_id}}">{{ $item->espaco }}</a></p>
                    <p class="card-text">Quando? {{ $item->data }} das {{ $item->hora_inicio}} às {{ $item->hora_fim }} </p>
                    <button class="btn btn-primary" id="convidar" onclick="convidar({{$item->evento_id}}, {{$idArtista}})">Participar!</button>
                    </div>
                </div>
                @else
                <div class="card">
                    <div class="card-body">
                    <h3 class="card-title"><a href="espaco/perfil/{{ $item->espaco }}">{{ $item->espaco}}</a></h3>
                    <button class="btn btn-primary" id="convidar">Ver Agenda</button>
                    </div>
                </div>
                @endif
            
        @endforeach
    <div>
@endif

@section('scripts_adicionais')
    <script>
        function convidar(idEvt, idArt){
            button = document.getElementById('convidar');
            let xhr = new XMLHttpRequest();
            xhr.open('GET', `http://localhost:8000/api/enviarconvite/${idEvt}/${idArt}/0`);
            xhr.send(null);
            xhr.onreadystatechange = () => {
                if(xhr.readyState === 4){
                    alert('convite enviado')
                }
            }
        }
    </script>
@endsection

@endsection