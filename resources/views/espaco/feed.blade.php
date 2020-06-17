@extends('layouts.index')

@section('container')

@if(isset($feed))
    <div id="feed">
        <h2>Sugestões</h2>
        @foreach($feed as $artista)
            <div class="card">
                <div class="card-body">
                <h3 class="card-title"><a href="http://localhost:8000/artista/perfil/{{ $artista->id }}">{{ $artista->nome}}</a></h3>
                <p>{{ $artista->nome }} toca {{ $artista->genero }}!</p>
                <p>{{ $artista->quantidade_membros}} membro(s) </p>
                <p><a href="{{ $artista->link}}" target="_blank">Ouça</a></p>
                <button class="btn btn-primary" id="convidar" onclick="preencherEventos({{ $artista->id }})" data-toggle="modal" data-target="#exampleModal">Convidar</button>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Escolha um evento</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <div class="modal-body">
                            <select id="selEventos" class="form-control">
                            </select>
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" onclick="convidar()">Enviar Convite</button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    <div>
@endif
@section('scripts_adicionais')
    <script>
        const sel = document.getElementById('selEventos');
        var idArtista;

        function preencherEventos(idArt){
            let id = {{ $idEspaco }};
            idArtista = idArt;
            let xhr = new XMLHttpRequest();
            xhr.open('GET', `http://localhost:8000/api/listareventos/${id}/`);
            xhr.send(null);
            xhr.onreadystatechange = () => {
                if(xhr.readyState === 4){
                    
                    while (sel.firstChild){
                        sel.removeChild(sel.lastChild);
                    }
                    let eventos = JSON.parse(xhr.responseText);
                    eventos.forEach(evento =>{
                        let opt = document.createElement('option');
                        opt.text = evento.nome;
                        opt.value = evento.id;
                        sel.appendChild(opt);
                    })
                }
            }
        }
        function convidar(){
            let idEvento = sel.options[sel.selectedIndex].value;
            
            button = document.getElementById('convidar');
            let xhr = new XMLHttpRequest();
            xhr.open('GET', `http://localhost:8000/api/enviarconvite/${idEvento}/${idArtista}/1`);
            xhr.send(null);
            xhr.onreadystatechange = () => {
                if(xhr.readyState === 4){
                    if(JSON.parse(xhr.responseText) == 1)
                        alert('convite enviado');
                    else
                        alert('esse convite já foi enviado');
                }
            }
        }
        
    </script>
@endsection
@endsection