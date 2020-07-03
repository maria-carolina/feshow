@extends('layouts.index')

@section('container')

<div id="perfil">
@if(isset($evento))
    <h1>{{ $evento->nome }}</h1>
    <h2 id="cinza"> <a style="color: #ABA29F; text-decoration: none;"
    href="/artista/perfil/{{ $evento->espaco->id }}">{{ $evento->espaco->nome}}</a></h2>


    <p>{{ $evento->descricao}}</p>

    <h3> Line-up: </h3>
    <ul id="lineup" class="list-group">
    @foreach($rs as $linha)
        <li class="list-group-item">
        <a href="/artista/perfil/{{ $linha->artista_id }}">{{ $linha->artista }}</a>
        </li>
    @endforeach
   </ul>


    <ul id="data_horario">
        <li>{{ date('d/m/Y', strtotime($evento->data_inicio)) }} </li>
        <li>{{ date('H:i', strtotime($evento->hora_inicio)) }} -
        {{ date('H:i', strtotime($evento->hora_fim)) }}</li>
    </ul>

    @if(Auth::user()->id == $evento->espaco->user_id)
        
        <button  id="convidar" class="btn btn-outline-primary"><a style="color: #000000; text-decoration: none;" href="convite/{{ $evento->id }}">Convidar Artista</a></button>
      

        <button id="status" class="btn btn-primary btn-lg btn-block" data-toggle="modal" data-target="#exampleModal" >
        @if($evento->status == 0)
            Fechar
        @else
            Reabrir
        @endif
        </button>

    @endif

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Deseja realmente mudar o status desse evento?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>

                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Não</button>
                <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="mudarStatus()">Sim</button>
                </div>
            </div>
        </div>
    </div>

    @if(Auth::user()->tipo_usuario == 1)
        @if(!isset($evento->convite))
            <button class="btn btn-primary" id="convidar" onclick="enviarConvite()">Participar!</button>
        @elseif($evento->convite == '0')
            <p class="card-text">Você já enviou convite para esse evento.</p>
        @elseif($evento->convite == '1')
            <button class="btn btn-primary" id="aceitar" onclick="aceitarConvite({{$evento->id}})">Aceitar convite!</button>
        @elseif($evento->convite == '2')
            <p class="card-text">Você já está nesse evento.</p>
        @endif


    @endif


</div>
@endif
@endsection

@section('scripts_adicionais')
    <script>
        var idEvento = {{ $evento->id }};

        function enviarConvite(){
            let idUser = {{ Auth::user()->id }};
            var xhr = new XMLHttpRequest();
            xhr.open('GET', `http://localhost:8000/api/acharIdArtista/${idUser}`);
            xhr.send(null);

            xhr.onreadystatechange = () => {
                if(xhr.readyState === 4){
                    let idArtista = JSON.parse(xhr.responseText).id;
                    var xhr2 = new XMLHttpRequest();
                    xhr2.open('GET', `http://localhost:8000/api/enviarconvite/${idEvento}/${idArtista}/0`);
                    xhr2.send(null);
                    xhr2.onreadystatechange = () => {
                        if(xhr2.readyState === 4){
                            swal({
                                title: 'Solicitação enviada!',
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
            }
        }

        function mudarStatus(){
            
            var xhr = new XMLHttpRequest();
            xhr.open('GET', `http://localhost:8000/api/mudarstatusevento/${idEvento}`);
            xhr.send(null);

            xhr.onreadystatechange = () => {
                if(xhr.readyState === 4){
                    var msg = JSON.parse(xhr.responseText);
                    swal({
                        title: msg,
                        timer: 3000,
                        icon: "info",
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
                    
                    var btn = document.getElementById('status');
                    if(msg === "FESHOW!" || msg === "Reaberto!"){
                        if(btn.innerHTML == "Reabrir"){
                            btn.innerHTML = "Fechar";
                            document.getElementById("convidar").style = "display: block;";
                        }else{
                            btn.innerHTML = "Reabrir";
                            document.getElementById("convidar").style = "display: none;";
                        }
                    }
                }
            }
        }

        function aceitarConvite(evento){
            var xhr = new XMLHttpRequest();
            var idEvento = evento;
            var idArtista = {{ $logado->id }};

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

                    var lista = document.getElementById("lineup");
                    var item = document.createElement("li");
                    item.setAttribute("class", "list-group-item");

                    var link = document.createElement('a');
                    var nome = document.createTextNode('{{$logado->nome}}');

                    link.setAttribute('href', '/artista/perfil/{{ $logado->id }}');

                    link.appendChild(nome);

                    item.appendChild(link);
                    lista.appendChild(item);
                }
            }
        }


    </script>
@endsection

