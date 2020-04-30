@extends('layouts.index')

@section('container')

<form method="post" action="{{ route('salvar_casa') }}">
    {{ csrf_field() }}
    <div class="form-row">
        <div class="col">
            <label for="nome">Qual o nome da sua casa?</label>
            <input type="text" id="nome" name="txtNome" class="form-control"/>
        </div>

        <div class="col">
            <label for="telefone">Telefone:</label>
            <input type="tel" id="telefone" name="txtTelefone" class="form-control"/>
        </div>
        <div class="col">
            <label for="generos">Informe o gênero:</label>
            <select id="generos" name="cmbGenero" class="form-control">
                @foreach($generos as $genero)
                <option value="{{ $genero->id }}">{{ $genero->nome }}</option>
                @endforeach
            </select>

        </div>
    </div>

    <div class="form-row mt-3">
        <div class="col">
            <label for="logradouro">Logradouro: </label>
            <input type="text" id="logradouro" name="txtLogradouro" class="form-control"/>
        </div>

        <div class="col">
            <label for="numero">Nº: </label>
            <input type="text" id="numero" name="txtNum" class="form-control"/>
            
        </div>


        <div class="col">
            <label for="cep">CEP</label>
            <input type="text" id="cep" name="txtCep" class="form-control"/>
        </div>
    </div>

    <div class="form-row mt-3">
        <div class="col">
            <label for="bairro">Bairro: </label>
            <input type="text" id="bairro" name="txtBairro" class="form-control"/>
        </div>
        <div class="col">
            <label for="cidade">Cidade: </label>
            <input type="text" id="cidade" name="txtCidade" class="form-control"/>
            
        </div>
        <div class="col">
            <label for="uf">UF </label>
            <select id="uf" name="cmbUf" class="form-control">
                <option value="SP">SP</option>
                <option value="RJ">RJ</option>
            </select>
            
        </div>

       
    </div>

    <div class="form-row mt-3">
        <div class="col">
            <label for="login">Escolha um username para poder logar na plataforma</label>
            <input type="text" id="login" name="txtLogin" class="form-control"/>
        </div>
        <div class="col">
            <label for="email">E-mail:</label>
            <input type="email" id="email" name="txtEmail" class="form-control"/>
        </div>
    </div>

    <div class="form-row mt-3">
        <div class="col">
            <label for="senha">Escolhar uma senha:</label>
            <input type="password" id="senha" name="txtSenha" class="form-control"/>

        </div>
        <div class="col">
            <label for="senha">Repita a senha:</label>
            <input type="password" id="rsenha" name="txtRsenha" class="form-control"/>
        </div>
    </div>

    <input type="hidden" name="txtTipo" value="0">
    <div class="mx-auto" style="width: 200px;">
        <button id="cadastrar" type="submit" class="btn btn-outline-dark">Salvar</button>
    </div>

    </div>
</form>
@endsection


