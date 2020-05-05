@extends('layouts.index')

@section('container')

<h1>{{ $evento->nome }}</h1>
<form>
    <input type="text" name="txtArtista" id="">
    <button type="button" name="txtAddArtista">OK</button>
    
</form>

@section('scripts_adicionais')
    <script>
        var button = document.querySelector('button[name=txtAddArtista]');
        var inputArtista = document.querySelector('input[name=txtArtista]');
        var body = document.querySelector('body');

        button.onclick = () =>{
            //alert('oi');
            /*var text = document.createTextNode(inputArtista.value);
            var nome = document.createElement('h1');
            nome.appendChild(text);

            text = document.createTextNode("rock, pop, jazz");
            var generos = document.createElement('p');
            generos.appendChild(text);

            var btnYes = document.createElement("button");
            btnYes.appendChild(document.createTextNode('Confirmar'));
            btnYes.id = "yes";

            var btnNo = document.createElement("button");
            btnNo.appendChild(document.createTextNode('Cancelar'));
            btnNo.id = "no";


            divArtista.appendChild(nome);
            divArtista.appendChild(generos);
            divArtista.appendChild(btnYes);
            divArtista.appendChild(btnNo);
            divArtista.style.borderStyle = "solid";*/

            var xhr = new XMLHttpRequest();
            xhr.open('GET', `http://localhost:8000/api/pesquisarArtista/${inputArtista.value}/`);
            xhr.send(null);
            
            xhr.onreadystatechange = () => {
                if(xhr.readyState === 4){
                    var resposta = JSON.parse(xhr.responseText);
                    var generosStrings = [];
                    
                    let ids = [];
                    let resultados = [];
                    resposta.forEach(linha =>{
                        if(!ids.includes(linha.id)){
                            resultados.push(linha);
                            generosStrings[linha.id - 1] = linha.genero
                        }else{
                            generosStrings[linha.id - 1] += ` ${linha.genero}`
                        }
                        ids.push(linha.id);
                    });

                    console.log(resultados);
                    

                    resultados.forEach(linha => {

                        var text = document.createTextNode(linha.nome);
                        var nome = document.createElement('h1');
                        nome.appendChild(text);

                        text = document.createTextNode(generosStrings[linha.id - 1]);
                        var generos = document.createElement('p');
                        generos.appendChild(text);

                        var btnYes = document.createElement("button");
                        btnYes.appendChild(document.createTextNode('Confirmar'));
                        btnYes.id = "yes";

                        var btnNo = document.createElement("button");
                        btnNo.appendChild(document.createTextNode('Cancelar'));
                        btnNo.id = "no";

                        console.log('opa')
                        divArtista = document.createElement('div');
                        divArtista.setAttribute('class', 'caixaArtista');

                        console.log(divArtista.class);

                        divArtista.appendChild(nome);
                        divArtista.appendChild(generos);
                        divArtista.appendChild(btnYes);
                        divArtista.appendChild(btnNo);
                        divArtista.style.borderStyle = "solid";

                        body.appendChild(divArtista);
                    });
                }
            }
        }

        

    </script>
@endsection

@endsection