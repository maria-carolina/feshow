@extends('layouts.index')

@section('links_adicionais')
    <style>
        body {font-family: Arial;}

        /* Style the tab */
        .tab {
            overflow: hidden;
            border: 1px solid #ccc;
            background-color: #f1f1f1;
        }

        /* Style the buttons inside the tab */
        .tab button {
            background-color: inherit;
            float: left;
            border: none;
            outline: none;
            cursor: pointer;
            padding: 14px 16px;
            transition: 0.3s;
            font-size: 17px;
        }

        /* Change background color of buttons on hover */
        .tab button:hover {
            background-color: #eaa9ea;
        }

        /* Create an active/current tablink class */
        .tab button.active {
            background-color: #eaa9ea;
        }

        /* Style the tab content */
        .tabcontent {
            display: none;
            padding: 6px 12px;
            border-top: none;
        }
    </style>
@endsection

@section('container')
    <div class="tab mt-3">
        <button class="tablinks active" onclick="openDiv(event, 'Recebidos')">Convites Recebidos</button>
        <button class="tablinks" onclick="openDiv(event, 'Solicitacoes')">Solicitações de eventos</button>
        <button class="tablinks" onclick="openDiv(event, 'Enviados')">Convites Enviados</button>
    </div>

    <div id="Recebidos" class="tabcontent" style="display:block">
        <h3>Convites Recebidos:</h3>
        @if(isset($convites_recebidos))
            @foreach($convites_recebidos as $key => $convite)
                <div class="card" id="{{$key}}" >
                    <div class="card-body">
                        <h5 class="card-title">
                            <a href="/artista/perfil/{{ $convite->artista_id }}">{{ $convite->artista }}</a>
                            &nbsp; quer tocar no &nbsp;
                            <a href="/evento/{{ $convite->evento_id }}"> {{ $convite->evento}}</a>
                        </h5>
                        <button class="btn btn-primary" id='yes' onclick="responder(true, {{$key}})"> Aceitar </button>
                        <button class="btn btn-secondary" id='no' onclick="responder(false, {{$key}})"> Rejeitar </button>
                        <input type="hidden" name="art" value="{{ $convite->artista_id}}">
                        <input type="hidden" name="evt" value="{{ $convite->evento_id }}">
                    </div>
                </div>
            @endforeach
        @endif
    </div>

    <div id="Solicitacoes" class="tabcontent">
        <h3>Solicitações de evento</h3>
        @if($solicitacoes->count() > 0)
            @foreach($solicitacoes as $solicitacao)
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ $solicitacao->nome}}</a> deseja solicitar um evento para o dia {{ date('d/m/Y', strtotime($solicitacao->data)) }}</h5>
                        <a href="#" class="btn btn-primary" onclick="responderSolicitacao({{$solicitacao->artista_id}}, {{$solicitacao->solicitacao_id}})">Aceitar</a>
                        <a href="#" class="btn btn-secondary" onclick="responderSolicitacao(null, {{$solicitacao->solicitacao_id}})">Rejeitar</a>
                    </div>
                </div>
            @endforeach
        @else
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Não há solicitações de eventos até o momento</h5>
                </div>
            </div>
        @endif
    </div>

    <div id="Enviados" class="tabcontent">
        <h3>Convites Enviados:</h3>
        <table class="table">
            @if(isset($convites_enviados))
                @foreach($convites_enviados as $key => $convite)
                    <tr scope="row" id="row{{$key}}">
                        <td>
                            <h5 class='card-title'>
                                Você convidou <a href="/artista/perfil/{{ $convite->artista_id }}">{{ $convite->artista}}</a>
                                para o <a href="/evento/{{ $convite->evento_id}}">{{ $convite->evento}}</a>
                            </h5>
                        </td>
                        <td>
                            <button class="btn btn-secondary"
                                    onclick="cancelar({{ $convite->artista_id}}, {{ $convite->evento_id }}, {{$key}})">Cancelar</button>
                        </td>
                    </tr>
                @endforeach
            @endif
        </table>
    </div>
@endsection


@section('scripts_adicionais')
    <script>
        function responder(resp, idCard){

            var xhr = new XMLHttpRequest();
            var idEvento = document.querySelector('input[name=evt]').value;
            var idArtista = document.querySelector('input[name=art]').value;
            if(resp){
                xhr.open('GET', `http://localhost:8000/api/responderConvite/${idEvento}/${idArtista}/0`);
            }else{
                xhr.open('GET', `http://localhost:8000/api/responderConvite/${idEvento}/${idArtista}/1`);
            }

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
                    );
                    var card = document.getElementById(idCard);
                    card.parentNode.removeChild(card);
                }
            }
        }

        function cancelar(artista, evento, idRow){
            var xhr = new XMLHttpRequest();
            xhr.open('GET', `http://localhost:8000/api/deletarConvite/${evento}/${artista}`);
            xhr.send(null);
            xhr.onreadystatechange = () => {
                if(xhr.readyState === 4){
                    swal({
                        title: 'Convite cancelado!',
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
                    );
                    var row = document.getElementById("row"+idRow);
                    row.parentNode.removeChild(row);
                }
            }

        }


        function openDiv(evt, cityName) {
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }
            tablinks = document.getElementsByClassName("tablinks");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
            }
            document.getElementById(cityName).style.display = "block";
            evt.currentTarget.className += " active";
        }


        function responderSolicitacao(idArtista, idSolicitacao){
            if(idArtista != null){
                swal({
                    title: "Confirma criação de evento?",
                    text: "Ao confirmar você poderá criar um evento e este artista será convidado para o mesmo",
                    icon: "info",
                    buttons: true,
                    showConfirmButton: true,
                })
                    .then((willDelete) => {
                        if (willDelete) {
                            window.open("/evento/" + idArtista + "/criarSolicitacao/"+ idSolicitacao, "_self");
                        }
                    });
            } else {
                swal({
                    title: "Deseja rejeitar solicitação?",
                    text: "Ao confirmar, esta solicitação será apagada",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                    .then((willDelete) => {
                        window.open("/evento/deletar/solicitacao/"+ idSolicitacao, "_self");
                    });
            }

        }

    </script>
@endsection

