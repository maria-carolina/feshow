@extends('layouts.index')

@section('container')
    <div id="feed" class="mt-5">
        <h2>Sugestões</h2>
        @if(isset($feed))
            @foreach($feed as $item)

                @if(isset($item->evento))
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title"><a href="/evento/{{ $item->evento_id }}">{{ $item->evento}}</a></h3>
                            <p class="card-text">Onde? <a href="/espaco/perfil/{{ $item->espaco_id}}">{{ $item->espaco }}</a></p>
                            <p class="card-text">Quando? {{ date('d/m/Y', strtotime($item->data_inicio))}} das {{ date('H:i', strtotime($item->hora_inicio))}} às {{  date('H:i', strtotime($item->hora_fim)) }} </p>
                            @if(!isset($item->convite))
                                <button class="btn btn-primary" id="convidar" onclick="convidar({{$item->evento_id}}, {{$artista_id}})">Participar!</button>
                            @elseif($item->convite == '0')
                                <p class="card-text">Você já enviou convite para esse evento.</p>
                            @elseif($item->convite == '1')
                                <button class="btn btn-primary" id="aceitar" onclick="aceitar({{$item->evento_id}})">Aceitar convite!</button>
                            @elseif($item->convite == '2')
                                <p class="card-text">Você já está nesse evento.</p>
                            @endif

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
        @else
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Não há sugestões no momento</h5>
                </div>
            </div>
        @endif
 @endsection

            @section('scripts_adicionais')
                <script>
                    function convidar(idEvt, idArt){
                        button = document.getElementById('convidar');
                        let xhr = new XMLHttpRequest();
                        xhr.open('GET', `http://localhost:8000/api/enviarconvite/${idEvt}/${idArt}/0`);
                        xhr.send(null);
                        xhr.onreadystatechange = () => {
                            if(xhr.readyState === 4){
                                swal({
                                    title: 'Convite enviado!',
                                    timer: 2000,
                                    icon: "success",
                                    showCancelButton: false,
                                    showConfirmButton: false
                                }).then(
                                    function () {},
                                    // handling the promise rejection
                                    function (dismiss) {
                                        if (dismiss === 'timer') {

                                        }
                                    }
                                )

                                var btn = document.getElementById('convidar');
                                var div = btn.parentNode;
                                div.removeChild(btn);

                                var p = document.createElement('p');
                                p.setAttribute('class', 'card-text');
                                p.appendChild(document.createTextNode("Espera a resposta."));
                                div.appendChild(p);
                            }
                        }
                    }

                    function aceitar(evento){
                        var xhr = new XMLHttpRequest();
                        var idEvento = evento;
                        var idArtista = {{ $artista_id }};

                        xhr.open('GET', `http://localhost:8000/api/responderConvite/${idEvento}/${idArtista}/0`);

                        xhr.send(null);
                        xhr.onreadystatechange = () => {
                            if(xhr.readyState === 4){
                                swal({
                                    title: 'Resposta enviada!',
                                    timer: 2000,
                                    icon: "success",
                                    showCancelButton: false,
                                    showConfirmButton: false
                                }).then(
                                    function () {},
                                    // handling the promise rejection
                                    function (dismiss) {
                                        if (dismiss === 'timer') {

                                        }
                                    }
                                )
                                var btn = document.getElementById('aceitar');
                                var div = btn.parentNode;
                                div.removeChild(btn);

                                var p = document.createElement('p');
                                p.setAttribute('class', 'card-text');
                                p.appendChild(document.createTextNode("Você já está nesse evento."));
                                div.appendChild(p);
                            }
                        }
                    }
                </script>
@endsection

