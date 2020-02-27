
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
        <form method="post" action="{{ isset($artista)?
            route('alterar_artista', ['id' =>$artista->id]) : route('salvar_artista') }}">
            {{ csrf_field() }}
            <div id="campos">
                <label for="nome">Qual o nome da sua banda ou projeto?</label>
                <input type="text" id="nome" name="txtNome"
                       value="{{isset($artista) ? $artista->nome : ""}}"/>

                <label for="email">E-mail para contato?</label>
                <input type="email" id="email" name="txtEmail"
                       value="{{isset($artista) ? $artista->email : ""}}"/>

                <label for="qtdmembros">Quantos membros tem sua banda?</label>
                <input type="number" id="qtdmembros" name = "txtQtd"
                       value="{{isset($artista) ? $artista->quantidade_membros : ""}}"/>

                <label for="telefone">Telefone:</label>
                <input type="tel" id="telefone" name="txtTelefone"
                       value="{{isset($artista) ? $artista->telefone : ""}}"/>

                <label for="cidade">Cidade: </label>
                <input type="text" id="cidade" name="txtCidade"
                       value="{{isset($artista) ? $artista->cidade : ""}}"/>

                <label for="link">As casas querem te ouvir!
                    Deixa aí algum link (spotify, soundcloud, youtube)</label>
                <input type="text" id="link" name="txtLink"
                       value="{{isset($artista) ? $artista->link : ""}}"/>

                <label for="generos">Informe o gênero:</label>
                <select id="generos" name="cmbGenero">
                    @foreach($generos as $genero)
                        @if($genero->id == $artista->genero_id)
                            <option value="{{ $genero->id }}" selected>{{ $genero->nome }}</option>
                        @else
                            <option value="{{ $genero->id }}">{{ $genero->nome }}</option>
                        @endif
                    @endforeach
                </select>

                <label for="login">Escolha um username para poder logar na plataforma</label>
                <input type="text" id="login" name="txtLogin"/>

                <label for="senha">Escolhar uma senha:</label>
                <input type="password" id="senha" name="txtSenha"/>

                <label for="senha">Repita a senha:</label>
                <input type="password" id="rsenha" name="txtRsenha"/>

                <button id="cadastrar"type="submit">Salvar</button>
            </div>
        </form>
        <script>


        </script>
    </body>
</html>
