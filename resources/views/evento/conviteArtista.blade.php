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
           
            var divs = document.querySelector('div[class=caixaArtista]');
            if(divs)
                divs.parentNode.removeChild(divs);
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

                        var link = document.createElement('a');
                        link.href = `/artista/perfil/${linha.id}`;
                        link.appendChild(nome);

                        btnYes.addEventListener("click", () => {
                            enviarConvite(linha.id);
                        });

                        console.log('opa')
                        divArtista = document.createElement('div');
                        divArtista.setAttribute('class', 'caixaArtista');
                        divArtista.id = linha.id;
                    

                        divArtista.appendChild(link);
                        divArtista.appendChild(generos);
                        divArtista.appendChild(btnYes);
                        divArtista.style.borderStyle = "solid";

                        body.appendChild(divArtista);
                    });
                }
            }
        }


        function enviarConvite(idArtista){
            let idEvento = {{ $evento->id }};
            var xhr = new XMLHttpRequest();
            xhr.open('GET', `http://localhost:8000/api/enviarconvite/${idEvento}/${idArtista}/1`);
            xhr.send(null);
            xhr.onreadystatechange = () => {
                if(xhr.readyState === 4){
                    let div = document.getElementById(idArtista);
                    div.parentNode.removeChild(div);
                }
            }
        }

        

    </script>
@endsection

@endsection