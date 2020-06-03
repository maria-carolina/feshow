@extends('layouts.index')

@section('container')
    @foreach($convites as $convite)
        <div class="caixaArtista">
            <a href="/espaco/perfil/{{ $convite->espaco_id}}">{{ $convite->espaco }}<a> 
            &nbsp; te convidou pra tocar em &nbsp;
            <a href="/evento/{{ $convite->evento_id}}">{{ $convite->evento}}<a>
            <button id="yes" onclick="responder(true, {{ $convite->evento_id }})"> Aceitar </button>
            <button id="no" onclick="responder(false, {{ $convite->evento_id }})"> Rejeitar </button>
        </div>
    @endforeach

@section('scripts_adicionais')
    <script>
        function responder(resp, evento){
            
            var xhr = new XMLHttpRequest();
            var idEvento = evento;
            var idArtista = {{ $artista_id }};
            if(resp){
                xhr.open('GET', `http://localhost:8000/api/responderConvite/${idEvento}/${idArtista}/0`);
            }else{
                xhr.open('GET', `http://localhost:8000/api/responderConvite/${idEvento}/${idArtista}/1`);
            }

            xhr.send(null);
            xhr.onreadystatechange = () => {
                if(xhr.readyState === 4){
                    alert('resposta enviada');
                }
            }
        }
    </script>
@endsection
@endsection