@extends('layouts.index')

@section('container')

<h1>{{ $evento->nome }}</h1>
<form>
    <input type="text" name="txtArtista" id="">
    <button type="button" name="txtAddArtista">OK</button>
    
    <div name="confirmacao" id="artistas_adicionados"></div>
    <div id="confirmacao_artista"></div>
</form>

@section('scripts_adicionais')
    <script>
        var button = document.querySelector('button[name=txtAddArtista]');
        var inputArtista = document.querySelector('input[name=txtArtista]');
        var divConfirmacao = document.querySelector('div[name=confirmacao]');

        button.onclick = () =>{
            //alert('oi');
            var text = document.createTextNode(inputArtista.value);
            var par = document.createElement('p');
            par.appendChild(text);

            var buttonPos = document.createElement('button');
            buttonPos.appendChild(document.createTextNode('esse mesmo!'));
            buttonPos.type = "button";
            buttonPos.name = "btnYes"

            var buttonNeg = document.createElement('button');
            buttonNeg.appendChild(document.createTextNode('nah!'));
            buttonNeg.type = "button";
            buttonNeg.name = "btnNo";


            var buttons = document.createElement('ul');
            var item = document.createElement('li');
            item.appendChild(buttonPos);
            buttons.appendChild(item);

            item = document.createElement('li');
            item.appendChild(buttonNeg);
            buttons.appendChild(item);

            buttons.style.position = "absolute";
            buttons.style.right = "0px";
            buttons.style.bottom = "0px";

            divConfirmacao.style.position = "relative";
            divConfirmacao.style.borderStyle = "solid";
            divConfirmacao.style.width = "50%";
            divConfirmacao.style.height = "200px";
            divConfirmacao.appendChild(par);
            divConfirmacao.appendChild(buttons);
        }

        ///COLOCAR OS EVENTOS DOS BOTÕES DE CONFIRMAÇÃO

    </script>
@endsection

@endsection