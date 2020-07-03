@extends('layouts.index')

@section('container')
<h2>Eventos:</h2>
    @if(isset($eventos))
        @foreach($eventos as $key => $evento)
            <div class="card" id="{{$key}}" >
                <div class="card-body">
                    <h5 class="card-title">
                        <a href="/evento/{{ $evento->id }}">{{ $evento->nome }}</a>
                        &nbsp; @ &nbsp;
                        <a href="/espaco/perfil/{{ $evento->espaco_id }}"> {{ $evento->espaco}}</a>
                    </h5>
                    <p> {{$evento->data_inicio}}
                    @if($evento->data_inicio != $evento->data_fim)
                        - {{ $evento->data_fim }}
                    @endif </p>

                    <p> {{$evento->hora_inicio}} - {{$evento->hora_fim}}</p>

                    <button class="btn btn-primary" data-toggle="modal" data-target="#modal{{$key}}"> Deixar evento </button>
                    <input type="hidden" name="evt" value="{{ $evento->id }}">
                </div>
            </div>
            <div class="modal fade" id="modal{{ $key }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Deseja realmente sair desse evento?</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>

                        <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Não</button>
                        <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="sair({{$key}})">Sim</button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
@endsection


@section('scripts_adicionais')

    <script>
        function sair(idCard){
            var evento = document.querySelector('input[name=evt]').value;
            var artista = {{ $artista_id }};
            var xhr = new XMLHttpRequest();
            xhr.open('GET', `http://localhost:8000/api/deixarevento/${evento}/${artista}/`);

            xhr.send(null);

            xhr.onreadystatechange = () => {
                if(xhr.readyState === 4){
                    swal({
                        title: 'Você foi removido do evento!',
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
    </script>

@endsection
