@extends('layouts.index')

@section('container')

<form method="post" action="{{ isset($espaco)?
            route('alterar_espaco', ['id' =>$espaco->id]) : route('salvar_casa') }}">
    {{ csrf_field() }}
    <div class="mb-3 mt-4">
        <h5>Dados do espaço</h5>
        <hr>
    </div>
    <div class="form-row">
        <div class="col">
            <label for="nome">Qual o nome da sua casa?</label>
            <input type="text" id="nome" name="txtNome" class="form-control"
                value="{{isset($espaco) ? $espaco->nome : ""}}" required/>
        </div>

        <div class="col">
            <label for="telefone">Telefone:</label>
            <input type="tel" id="telefone" name="txtTelefone" class="form-control"
                value="{{isset($espaco) ? $espaco->telefone : ""}}"   />
        </div>

    </div>

    <div class="form-row mt-3">
        <div class="col">
            <label for="generos1">Informe o gênero:</label>
            <select id="generos1" name="cmbGenero_1" class="form-control" required
            onchange="validarGenero(1)">
            <option>Escolhar uma opção</option>
                @foreach($generos as $genero)
                    <option value="{{ $genero->id }}"
                    @if(isset($espaco->generos[0]) && $espaco->generos[0]->id == $genero->id)
                        selected
                    @endif
                    > {{ $genero->nome}}</option>
                @endforeach
            </select>
        </div>

        <div class="col">
            <label for="generos2">Informe o gênero:</label>
            <select id="generos2" name="cmbGenero_2" class="form-control"
            onchange="validarGenero(2)">
            <option>Escolhar uma opção</option>
                    @foreach($generos as $genero)
                        <option value="{{ $genero->id }}"
                        @if(isset($espaco->generos[1]) && $espaco->generos[1]->id == $genero->id)
                            selected
                        @endif
                        > {{ $genero->nome}}</option>
                    @endforeach
            </select>
        </div>

        <div class="col">
            <label for="generos3">Informe o gênero:</label>
            <select id="generos3" name="cmbGenero_3" class="form-control"
            onchange="validarGenero(3)">
            <option>Escolhar uma opção</option>
                    @foreach($generos as $genero)
                        <option value="{{ $genero->id }}"
                        @if(isset($espaco->generos[2]) && $espaco->generos[2]->id == $genero->id)
                            selected
                        @endif
                        > {{ $genero->nome}}</option>
                    @endforeach


            </select>

        </div>
    </div>
    <div class="form-row mt-3">
        <div class="col">
            <label for="link">Conta um pouco sobre você</label>
            <input type="text" id="descricao" name="txtDescricao" class="form-control"
                   value="{{isset($espaco) ? $espaco->descricao : ""}}" required/>

        </div>
    </div>

    <div class="mb-3 mt-5">
        <h5>Endereço</h5>
        <hr>
    </div>

    <div class="form-row mt-3">
        <div class="col-4">
            <label for="cep">CEP:</label>
            <input type="text" class="form-control" onkeypress="mask(this, '#####-###')"
                   maxlength="9" id="cep" name="txtCep"
                   value="{{isset($endereco) ? $endereco->cep : ""}}" placeholder="Digite o CEP (ex: 00000-000)" required>
        </div>
        <div class="col-6">
            <label for="rua">Rua:</label>
            <input type="text" class="form-control" name="txtLogradouro" id="rua"
                   value="{{isset($endereco) ? $endereco->logradouro : ""}}" required readonly>
        </div>
        <div class="col-2">
            <label for="numero">Número:</label>
            <input type="number" class="form-control" name="txtNum"  id="numero"
                   value="{{isset($endereco) ? $endereco->numero : ""}}"  required>
        </div>
    </div>

    <div class="form-row mt-3">
        <div class="col-4">
            <label for="cidade">Cidade:</label>
            <input type="text" class="form-control" name="txtCidade" id="cidade"
                   value="{{isset($endereco) ? $endereco->cidade : ""}}" required readonly>
        </div>
        <div class="col-4">
            <label for="Bairro">Bairro:</label>
            <input type="text" class="form-control" name="txtBairro" id="bairro"
                   value="{{isset($endereco) ? $endereco->bairro : ""}}" required readonly>
        </div>
        <div class="col-4">
            <label for="Uf">Estado:</label>
            <input type="text" class="form-control" name="txtUf" id="uf" maxlength="2"
                   value="{{isset($endereco) ? $endereco->uf : ""}}" required readonly>
        </div>
    </div>

    <div class="mb-3 mt-5">
        <h5>Dados do usuário</h5>
        <hr>
    </div>

    <div class="form-row mt-3">
        <div class="col">
            <label for="login">Escolha um username para poder logar na plataforma</label>
            <input type="text" id="login" name="txtLogin" class="form-control"
            value="{{isset($espaco) ? $espaco->user->name : ""}}" required/>
        </div>
        <div class="col">
            <label for="email">E-mail:</label>
            <input type="email" id="email" name="txtEmail" class="form-control"
                value="{{isset($espaco) ? $espaco->user->email : ""}}" required/>
        </div>
    </div>

    <div class="form-row mt-3">
        <div class="col">
            <label for="senha">Escolhar uma senha:</label>
            <input type="password" id="senha" name="txtSenha" class="form-control" required/>

        </div>
        <div class="col">
            <label for="senha">Repita a senha:</label>
            <input type="password" id="rsenha" name="txtRsenha" class="form-control" required/>
        </div>
    </div>

    <input type="hidden" name="txtTipo" value="0">
    <div class="mx-auto mt-3" style="width: 200px;">
        <button id="cadastrar" type="submit" class="btn btn-primary btn-lg">Salvar</button>
    </div>

    </div>
</form>
@endsection

@section('scripts_adicionais')
        <script>



            const dropdownsGeral = Array.from(document.getElementsByTagName('select'));
            const dropdowns = dropdownsGeral.filter(campo => campo.name.split("_")[0] == "cmbGenero")

            /*var xhr = new XMLHttpRequest();
            xhr.open('GET', '/api/listarGeneros/');
            xhr.send(null);

            const body = document.getElementsByTagName('body')[0]
            body.onload = () => {
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === 4){
                        const lista = JSON.parse(xhr.responseText);
                        dropdowns.forEach(campo => {
                            var opt = document.createElement('option');
                            opt.text = "Selecione uma opção";
                            opt.value = 0;
                            campo.append(opt);
                            lista.forEach(item => {
                                var opt = document.createElement('option');
                                opt.text = item.nome;
                                opt.value = item.id;
                                campo.appendChild(opt);
                            })
                        });
                    }
                }
            }*/

            function validarGenero(index){
                var campoSelecionado = document.querySelector(`select[name=cmbGenero_${index}`);
                var generoSelecionado = campoSelecionado.selectedIndex;

                dropdowns.forEach(campo =>{
                    if(campo != campoSelecionado &&
                    campo.selectedIndex == generoSelecionado){
                        campoSelecionado.selectedIndex = 0;
                        swal("","Você já selecionou esse gênero, escolha outro!" , "info");
                        return;
                    }
                })

            }
        </script>

    @includeIf('layouts.cep-api')

@endsection




