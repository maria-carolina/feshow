@extends('layouts.index')

@section('container')
    @if($solicitacoes->count() > 0)
        @foreach($solicitacoes as $solicitacao)
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{ $solicitacao->nome}}</a> deseja solicitar um evento para o dia {{ date('d/m/Y', strtotime($solicitacao->data)) }}</h5>
                    <a href="#" class="btn btn-primary" onclick="responder({{$solicitacao->artista_id}}, {{$solicitacao->solicitacao_id}})">Aceitar</a>
                    <a href="#" class="btn btn-secondary" onclick="responder(null, {{$solicitacao->solicitacao_id}})">Rejeitar</a>
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
@endsection

@section('scripts_adicionais')
    <script>
        function responder(idArtista, idSolicitacao){
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


        $(document).ready(function () {
            $("#close").click(function () {
                $("#modalEvento").dialog('close');
            });
        });
    </script>
@endsection
