@extends('layouts.index')

@section('container')
    <h2>Convites Recebidos:</h2>
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

    <h2>Convites Enviados:</h2>
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
    </script>
@endsection
