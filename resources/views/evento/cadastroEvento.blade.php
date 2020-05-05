@extends('layouts.index')

@section('container')

<form  method="post" action="{{ route('salvar_evento') }}">
    {{ csrf_field() }}
    <label for="nome">Insira o nome do evento:</label>
    <input type="text" name="txtNome" id="nome">

    <label for="descricao">Escreva uma descrição pro evento:</label>
    <textarea name="txtDescricao" id="descricao" cols="30" rows="10"></textarea>

    <label for="horario_inicio">Horário de início</label>
    <input type="time" name="txtHorarioInicio" id="horario_inicio">

    <label for="horario_fim">Horário do fim</label>
    <input type="time" name="txtHorarioFim" id="horario_fim">

    <label for="data_evento">Data do evento:</label>
    <input type="date" name="txtData" id="data_evento">

    <input type="submit" value="Criar evento">
</form>


@endsection
