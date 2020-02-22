
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <style>
            input, button {
                display: block;
            }
        </style>
    </head>
    <body>
        <form method="post" action="{{ route('salvar_artista') }}">
            {{ csrf_field() }}
            <div id="campos">
                <label for="nome">Qual o nome da sua banda ou projeto?</label>
                <input type="text" id="nome" name="txtNome"/>

                <label for="email">E-mail para contato?</label>
                <input type="email" id="email" name="txtEmail"/>

                <label for="qtdmembros">Quantos membros tem sua banda?</label> <br>
                <input type="number" id="qtdmembros" name = "txtQtd"/>

                <label for="telefone">Telefone:</label>
                <input type="tel" id="telefone" name="txtTelefone"/>

                <label for="cidade">Cidade: </label>
                <input type="text" id="cidade" name="txtCidade"/>

                <label for="link">As casas querem te ouvir!
                    Deixa aí algum link (spotify, soundcloud, youtube)</label>
                <input type="text" id="link" name="txtLink"/>

                <label for="generos">Informe o gênero:</label>
                <select id="generos" name="cmbGenero">
                    @foreach($generos as $genero)
                    <option value="{{ $genero->id }}">{{ $genero->nome }}</option>
                    @endforeach
                </select>

                <button type="submit">Salvar</button>
            </div>
        </form>

    </body>
</html>
