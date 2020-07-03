@extends('layouts.index')

@section('container')
<h2>Convites Recebidos:</h2>
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

    <h2>Convites Enviados:</h2>
    <table class="table">
    @if(isset($convites_enviados))
        @foreach($convites_enviados as $key => $convite)
            <tr scope="row" id="{{$key}}">
                <td>
                    <h5 class='card-title'>
                    Você convidou <a href="/artista/perfil/{{ $convite->artista_id }}">{{ $convite->artista}}<a> 
                    para o <a href="/evento/{{ $convite->evento_id}}">{{ $convite->evento}}<a>
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
                    alert('resposta enviada');
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
                    alert('Convite cancelado');
                    var row = document.getElementById(idRow);
                    row.parentNode.removeChild(row);
                }
            }

        }
    </script>
@endsection
@endsection