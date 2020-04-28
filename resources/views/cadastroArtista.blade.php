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

                <div class="col">
                    <label for="generos">Informe o gênero:</label>
                    <select id="generos" name="cmbGenero" class="form-control">
                    @foreach($generos as $genero)
                        @if(isset($artista) && $genero->id == $artista->genero_id)
                            <option value="{{ $genero->id }}" selected>{{ $genero->nome }}</option>
                        @else
                            <option value="{{ $genero->id }}">{{ $genero->nome }}</option>
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
            <div class="mx-auto" style="width: 200px;">
                <button id="cadastrar" type="submit" class="btn btn-outline-dark">Salvar</button>
            </div>
            </div>
        </form>

@endsection

