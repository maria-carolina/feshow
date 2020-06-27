@extends('layouts.index')

@section('container')
    <div class="title">
        <h3>Evento<br>
            <small>Espaço: {{$espaco->nome}}</small>
        </h3>
        @if(isset($artista))
            <small> <cite>Solicitação de {{$artista->nome}}</cite> </small>
        @endif
    </div>

<form  method="post"
       @if(isset($artista))
            action="{{ route('salvar_evento_solicitacao', $solicitacao->id) }}"
       @elseif(isset($data))
            action="{{ route('salvar_evento') }}"
       @else
            action="#"
       @endif
       >
    {{ csrf_field() }}
    <div class="form-row mt-3">
        <div class="col">
            <label for="nome">Insira o nome do evento:</label>
            <input type="text" class="form-control" name="txtNome" id="nome" value="{{old('txtNome')}}" required>
        </div>
    </div>

    <div class="form-row mt-3">
        <div class="col">
            <label for="descricao">Escreva uma descrição pro evento:</label>
            <textarea name="txtDescricao" class="form-control" id="descricao" cols="30" rows="3" value="{{old('txtDescricao')}}" required></textarea>
        </div>
    </div>

    <div class="form-row mt-3">
        <div class="col">
            <label for="data_evento">Data do início:</label> <br>
            <input type="date" class="form-control" name="txtDataInicio" id="data_inicio" value="" required>
        </div>
        <div class="col">
            <label for="data_evento">Data do fim:</label> <br>
            <input type="date"  class="form-control" name="txtDataFim" id="data_fim" required>
        </div>
    </div>

    <div class="form-row mt-3">
        <div class="col">
            <label for="horario_inicio">Horário de início</label>
            <input type="time" class="form-control" name="txtHorarioInicio" id="horario_inicio" required>
        </div>
        <div class="col">
            <label for="horario_fim">Horário do fim</label>
            <input type="time" class="form-control" name="txtHorarioFim" id="horario_fim" required>
        </div>
    </div>

    <div class="form-row mt-3">
        <div class="col offset-md-5">
            <button type="submit" class="btn btn-primary btn-lg">Criar evento</button>
        </div>
    </div>
</form>


@endsection
