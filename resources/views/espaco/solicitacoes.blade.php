@extends('layouts.index')

@section('container')
    @foreach($solicitacoes as $solicitacao)
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ $solicitacao->nome}}</a> deseja solicitar um evento para o dia {{ date('d/m/Y', strtotime($solicitacao->data)) }}</h5>
                <a href="#" class="btn btn-primary" onclick="responder(true)">Aceitar</a>
                <a href="#" class="btn btn-secondary" onclick="responder(false)">Rejeitar</a>
            </div>
        </div>
    @endforeach
@endsection

@section('scripts_adicionais')
    <script>
        function responder(resposta){
            if(resposta == true){
                swal({
                    title: "Confirma criação de evento?",
                    text: "Ao confirmar você poderá criar um evento e o artista sera adicionado ao lineup",
                    icon: "info",
                    buttons: true,
                    showConfirmButton: true,
                })
                    .then((willDelete) => {
                        if (willDelete) {
                            window.open("{{route('cadastro_evento')}}", "_self");
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
                        //quando for apagar
                    });
            }

        }

    </script>
@endsection
