@extends('layouts.index')

@section('container')

    <form method="post" action="{{ isset($artista)?
            route('alterar_artista', ['id' =>$artista->id]) : route('salvar_artista') }}">
        {{ csrf_field() }}

        <div class="mb-3 mt-4">
            <h5>Dados do artista</h5>
            <hr>
        </div>
        <div class="form-row mt-3">
            <div class="col">
                <label for="nome">Qual o nome da sua banda ou projeto?</label>
                <input type="text" id="nome" name="txtNome" class="form-control"
                       value="{{isset($artista) ? $artista->nome : ""}}" required/>
            </div>

            <div class="col">
                <label for="email">E-mail para contato?</label>
                <input type="email" id="email" name="txtEmail" class="form-control"
                       value="{{isset($artista) ? $artista->user->email : ""}}" required/>
            </div>
        </div>

        <div class="form-row mt-3">
            <div class="col">
                <label for="qtdmembros">Quantos membros tem sua banda?</label>
                <input type="number" id="qtdmembros" name = "txtQtd" class="form-control"
                       value="{{isset($artista) ? $artista->quantidade_membros : ""}}" required/>

            </div>

            <div class="col">
                <label for="telefone">Telefone:</label>
                <input type="tel" id="telefone" name="txtTelefone" class="form-control"
                       value="{{isset($artista) ? $artista->telefone : ""}}" />

            </div>
        </div>

        <div class="row align-items-end mt-3 mb-3">
            <div class="col-6">
                <label for="cep">CEP:</label>
                <input type="text" class="form-control"  onkeypress="mask(this, '#####-###')" maxlength="9" id="cep" name="txtCep" placeholder="Digite o CEP (ex: 00000-000)" required>
            </div>
            <div class="col-6">
                <label for="cidade">Cidade: </label>
                <input type="text" id="cidade" name="txtCidade" class="form-control"
                       value="{{isset($artista) ? $artista->cidade : ""}}" required readonly/>

            </div>
        </div>

        <div class="form-row mt-3">
            <div class="col">
                <label for="link">As casas querem te ouvir!
                    Deixa aí algum link (spotify, soundcloud, youtube)</label>
                <input type="text" id="link" name="txtLink" class="form-control"
                       value="{{isset($artista) ? $artista->link : ""}}" required/>

            </div>
        </div>

        <div class="form-row mt-3">
            <div class="col">
                <label for="generos1">Informe o gênero:</label>
                <select id="generos1" name="cmbGenero_1" class="form-control"
                        onchange="validarGenero(1)" required>
                    <option>Escolhar uma opção</option>
                    @foreach($generos as $genero)
                        <option value="{{ $genero->id }}"
                        @if(isset($artista) && $artista->generos[0]->id == $genero->id)
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
                        @if(isset($artista->generos[1]) && $artista->generos[1]->id == $genero->id)
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
                        @if(isset($artista->generos[2]) && $artista->generos[2]->id == $genero->id)
                            selected
                        @endif
                        > {{ $genero->nome}}</option>
                    @endforeach
                </select>

            </div>
        </div>

        <div class="mb-3 mt-5">
            <h5>Dados do usuário</h5>
            <hr>
        </div>

        <div class="form-row mt-3">
            <div class="col-6">
                <label for="login">Escolha um username para poder logar na plataforma</label>
                <input type="text" id="login" name="txtLogin" class="form-control"
                value="{{isset($artista) ? $artista->user->name : ""}}" required/>
            </div>
            <div class="col-3">
                <label for="senha">Escolhar uma senha:</label>
                <input type="password" id="senha" name="txtSenha" class="form-control" required/>
            </div>
            <div class="col-3">
                <label for="senha">Repita a senha:</label>
                <input type="password" id="rsenha" name="txtRsenha" class="form-control" required/>

            </div>
        </div>
        <input type="hidden" name="txtTipo" value="1">
        <div class="mx-auto mt-3" style="width: 200px;">
            <button id="cadastrar" type="submit" class="btn btn-primary btn-lg">Salvar</button>
        </div>
    </form>
@endsection

    @section('scripts_adicionais')
        <script>
            const dropdownsGeral = Array.from(document.getElementsByTagName('select'));
            const dropdowns = dropdownsGeral.filter(campo => campo.name.split("_")[0] == "cmbGenero");

            /*
             var xhr = new XMLHttpRequest();
            xhr.open('GET', '/api/listarGeneros/');


            const body = document.getElementsByTagName('body')[0]



            body.onload = () => {
                console.log('oi');
                xhr.send(null);
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === 4) {
                        const lista = JSON.parse(xhr.responseText);
                        dropdowns.forEach(campo => {
                            var opt = document.createElement('option');
                            opt.text = "Escolha uma opção";
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

