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
<form method="post" action="{{ route('salvar_casa') }}">
    {{ csrf_field() }}
    <div id="campos">
        <label for="nome">Qual o nome da sua casa?</label>
        <input type="text" id="nome" name="txtNome"/>

        <label for="telefone">Telefone:</label>
        <input type="tel" id="telefone" name="txtTelefone"/>

        <label for="logradouro">Logradouro: </label>
        <input type="text" id="logradouro" name="txtLogradouro"/>

        <label for="bairro">Bairro </label>
        <input type="text" id="bairro" name="txtBairro"/>

        <label for="cep">CEP</label>
        <input type="text" id="cep" name="txtCep"/>

        <label for="cidade">Cidade: </label>
        <input type="text" id="cidade" name="txtCidade"/>


        <label for="uf">UF </label>
        <select id="uf" name="cmbUf">
            <option value="SP">SP</option>
            <option value="RJ">RJ</option>
        </select>


        <label for="generos">Informe o gênero:</label>
        <select id="generos" name="cmbGenero">
            @foreach($generos as $genero)
            <option value="{{ $genero->id }}">{{ $genero->nome }}</option>
            @endforeach
        </select>

        <label for="login">Escolha um username para poder logar na plataforma</label>
        <input type="text" id="login" name="txtLogin"/>

        <label for="email">E-mail:</label>
        <input type="email" id="email" name="txtEmail"/>

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
