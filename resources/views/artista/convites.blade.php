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
        <button class="tablinks" onclick="openDiv(event, 'Enviados')">Convites Enviados</button>
    </div>

    <div id="Recebidos" class="tabcontent" style="display:block">
        <h4>Convites Recebidos:</h4>
        @if(isset($convites_recebidos))
            @foreach($convites_recebidos as $key => $convite)
                <div class="card" id="{{$key}}">
                    <div class="card-body">
                        <h5 class="card-title">
                            <a href="/espaco/perfil/{{ $convite->espaco_id}}">{{ $convite->espaco }}</a>
                            &nbsp;te convidou pra tocar em&nbsp;
                            <a href="/evento/{{ $convite->evento_id}}">{{ $convite->evento}}</a>
                        </h5>
                        <button class="btn btn-primary" id="yes" onclick="responder(true, {{ $convite->evento_id }}, {{$key}})"> Aceitar </button>
                        <button class="btn btn-secondary" id="no" onclick="responder(false, {{ $convite->evento_id }}, {{$key}})"> Rejeitar </button>
                    </div>
                </div>
            @endforeach
        @endif
    </div>

    <div id="Enviados" class="tabcontent">
        <h4>Convites Enviados:</h4>
        <table class="table">
            @if(isset($convites_enviados))
                @foreach($convites_enviados as  $key => $convite)
                    <tr scope="row" id="row{{$key}}">
                        <td>
                            <h5 class='card-title'>
                                Você solicitou participação no
                                <a href="/evento/{{ $convite->evento_id}}">{{ $convite->evento}}</a>
                            </h5>
                        </td>
                        <td>
                            <button class="btn btn-secondary" onclick="cancelar({{ $convite->evento_id }}, {{$key}})">Cancelar</button>
                        </td>
                    </tr>
                @endforeach
            @endif
        </table>
    </div>

@endsection

@section('scripts_adicionais')
    <script>
        function responder(resp, evento, idCard){

            var xhr = new XMLHttpRequest();
            var idEvento = evento;
            var idArtista = 1;
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

        function cancelar(evento, idRow){
            var xhr = new XMLHttpRequest();
            var idEvento = evento;
            var idArtista = {{ $artista_id }};

            xhr.open('GET', `http://localhost:8000/api/deletarConvite/${idEvento}/${idArtista}`);
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

    </script>
@endsection
