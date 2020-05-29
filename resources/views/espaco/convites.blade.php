@extends('layouts.index')

@section('container')
    @foreach($convites as $convite)
        <div class="caixaArtista">
            {{ $convite->artista }} quer tocar no {{ $convite->evento}}
            <button id='yes' onclick="responder(true)"> Aceitar </button>
            <button id='no' onclick="responder(false)"> Rejeitar </button>
            <input type="hidden" name="art" value="{{ $convite->artista_id}}">
            <input type="hidden" name="evt" value="{{ $convite->evento_id }}">
        </div>
    @endforeach
    
@section('scripts_adicionais')
    <script>
        function responder(resp){
            
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
                }
            }
        }
    </script>
@endsection
@endsection