@extends('layouts.index')

@section('container')

    <form method="post" action="{{ isset($artista)?
            route('alterar_artista', ['id' =>$artista->id]) : route('salvar_artista') }}">
            {{ csrf_field() }}
            <div class="form-row mt-3">
                <div class="col">
                <label for="nome">Qual o nome da sua banda ou projeto?</label>
                <input type="text" id="nome" name="txtNome" class="form-control"
                       value="{{isset($artista) ? $artista->nome : ""}}"/>
                </div>

                <div class="col">            
                <label for="email">E-mail para contato?</label>
                <input type="email" id="email" name="txtEmail" class="form-control"
                       value="{{isset($artista) ? $artista->email : ""}}"/>
                </div>
            </div>

            <div class="form-row mt-3">
                <div class="col">
                    <label for="qtdmembros">Quantos membros tem sua banda?</label>
                    <input type="number" id="qtdmembros" name = "txtQtd" class="form-control"
                        value="{{isset($artista) ? $artista->quantidade_membros : ""}}"/>
                
                </div>
                
                <div class="col">
                    <label for="telefone">Telefone:</label>
                    <input type="tel" id="telefone" name="txtTelefone" class="form-control"
                        value="{{isset($artista) ? $artista->telefone : ""}}"/>            
                
                </div>
            </div>


            <div class="form-row mt-3">
                <div class="col">
                    <label for="cidade">Cidade: </label>
                    <input type="text" id="cidade" name="txtCidade" class="form-control"
                        value="{{isset($artista) ? $artista->cidade : ""}}"/>
                
                </div>
                
                <div class="col">
                    <label for="link">As casas querem te ouvir!
                        Deixa aí algum link (spotify, soundcloud, youtube)</label>
                    <input type="text" id="link" name="txtLink" class="form-control"
                        value="{{isset($artista) ? $artista->link : ""}}"/>            
                
                </div>

        
            </div>

            <div class="form-row mt-3">
                <div class="col">
                    <label for="generos1">Informe o gênero:</label>
                    <select id="generos1" name="cmbGenero_1" class="form-control" 
                    onchange="validarGenero(1)">
                    @foreach($generos as $genero)
                        @if(isset($artista) && $genero->id == $artista->genero_id)
                            <option value="{{ $genero->id }}" selected>{{ $genero->nome }}</option>
                       
                        @endif            
                    @endforeach
                
                    </select>
                </div>

                <div class="col">
                    <label for="generos2">Informe o gênero:</label>
                    <select id="generos2" name="cmbGenero_2" class="form-control"
                    onchange="validarGenero(2)">
                    @foreach($generos as $genero)
                        @if(isset($artista) && $genero->id == $artista->genero_id)
                            <option value="{{ $genero->id }}" selected>{{ $genero->nome }}</option>

                        @endif            
                    @endforeach
                
                    </select>
                </div>

                <div class="col">
                    <label for="generos3">Informe o gênero:</label>
                    <select id="generos3" name="cmbGenero_3" class="form-control"
                    onchange="validarGenero(3)">
                    @foreach($generos as $genero)
                        @if(isset($artista) && $genero->id == $artista->genero_id)
                            <option value="{{ $genero->id }}" selected>{{ $genero->nome }}</option>
                        @endif            
                    @endforeach
                
                    </select>
                
                </div>
            </div>


            <div class="form-row mt-3">
                <div class="col">
                    <label for="login">Escolha um username para poder logar na plataforma</label>
                    <input type="text" id="login" name="txtLogin" class="form-control"/>            
                </div>
                <div class="col">
                    <label for="senha">Escolhar uma senha:</label>
                    <input type="password" id="senha" name="txtSenha" class="form-control"/>
                </div>
                
                <div class="col">
                    <label for="senha">Repita a senha:</label>
                    <input type="password" id="rsenha" name="txtRsenha" class="form-control"/>            
                    
                </div>
            </div>
            <input type="hidden" name="txtTipo" value="1">
            <div class="mx-auto" style="width: 200px;">
                <button id="cadastrar" type="submit" class="btn btn-outline-dark">Salvar</button>
            </div>
            </div>
        </form>

    @section('scripts_adicionais')
        <script>
            const body = document.getElementsByTagName('body')[0]
            const lista = [{"id": 1, "nome": "rock"},
                        {"id": 2, "nome": "samba"},
                        {"id": 3, "nome": "pop"},
                        {"id": 4, "nome": "jazz"},]

            const dropdowns = Array.from(document.getElementsByTagName('select'));

            body.onload = () => {
                dropdowns.forEach(campo => {
                    var opt = document.createElement('option');
                    opt.text = " ";
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

            function validarGenero(index){
                var campoSelecionado = document.querySelector(`select[name=cmbGenero_${index}`);
                var generoSelecionado = campoSelecionado.selectedIndex;

                dropdowns.forEach(campo =>{
                    if(campo != campoSelecionado && 
                    campo.selectedIndex == generoSelecionado){
                        campoSelecionado.selectedIndex = 0;
                        alert("Você já selecionou esse gênero, escolha outro!");
                        return;
                    }
                })
                
            }
        </script>
    @endsection

@endsection

