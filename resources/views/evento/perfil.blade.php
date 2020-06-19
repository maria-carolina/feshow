@extends('layouts.index')

@section('container')

<div id="perfil">
@if(isset($evento))
    <h1>{{ $evento->nome }}</h1>
    <h2 id="cinza"> <a style="color: #ABA29F; text-decoration: none;"
    href="/artista/perfil/{{ $evento->espaco->id }}">{{ $evento->espaco->nome}}</a></h2>

    
    <p>{{ $evento->descricao}}</p>

    <h3> Line-up: </h3>
    <ul class="list-group">
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
        <button class="btn btn-outline-primary"><a style="color: #000000; text-decoration: none;" href="convite/{{ $evento->id }}">Convidar Artista</a></button>
       
        <button id="status" class="btn btn-primary btn-lg btn-block"data-toggle="modal" data-target="#exampleModal" > 
        @if($evento->status == 0)
            FESHOW!
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
        <button onclick="enviarConvite()">Solicitar partipação</button>
    @endif
    @else
    <h1>{{ $evento->nome }}</h1>
    <h2>{{ $evento->espaco->nome}}</h2>

    <p>{{ $lineup }}</p>
    <p>{{ $evento->descricao}}</p>
    <ul id="data_horario">
        <li>{{ $evento->data_inicio }} </li>
        <li>{{ $evento->horario_inicio }} - {{ $evento->horario_fim }} </li>
    </ul>

      @endif
<div>

@section('scripts_adicionais')
    <script>
        var idEvento = {{ $evento->id }};

        function enviarConvite(){
            let idUser = {{ Auth::user()->id }}
            var xhr = new XMLHttpRequest();
            xhr.open('GET', `http://localhost:8000/api/acharIdArtista/${idUser}`);
            xhr.send(null);

            xhr.onreadystatechange = () => {
                if(xhr.readyState === 4){
                    let idArtista = JSON.parse(xhr.responseText).id;
                    console.log(idArtista);
                    var xhr2 = new XMLHttpRequest();
                    xhr2.open('GET', `http://localhost:8000/api/enviarconvite/${idEvento}/${idArtista}/0`);
                    xhr2.send(null);

                }
            }
        }

        function mudarStatus(){
            
            var xhr = new XMLHttpRequest();
            xhr.open('GET', `http://localhost:8000/api/mudarstatusevento/${idEvento}`);
            xhr.send(null);

            xhr.onreadystatechange = () => {
                if(xhr.readyState === 4){
                    alert(JSON.parse(xhr.responseText));
                    var btn = document.getElementById('status');
                    if(btn.innerHTML == "Reabrir")
                        btn.innerHTML = "FESHOW!"
                    else
                        btn.innerHTML = "Reabrir"
                    
                }
            };

        }

    </script>
@endsection
@endsection
