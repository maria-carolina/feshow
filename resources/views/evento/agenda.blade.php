@extends('layouts.index')

@section('container')
    <div class="title">
        <h3>Agenda<br>
            <small>Espaço: {{$espaco->nome}}</small>
        </h3>
    </div>

    <div id="calendar" class="mt-5"></div>
@endsection

@section('scripts_adicionais')
    <script>
        $(document).ready(function() {
            var calendar = $('#calendar').fullCalendar({
                editable:false,
                header:{
                    left:'prev,next today',
                    center:'title',
                    right:'month,agendaWeek,agendaDay'
                },
                events: {
                    url: '/api/agenda/{{$espaco->id}}'
                },
                selectable:true,
                selectHelper:true,
                monthNames: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
                monthNamesShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
                dayNames: ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sabado'],
                dayNamesShort: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sab'],
                buttonText: {
                    today: "Hoje",
                    month: "Mês",
                    week: "Semana",
                    day: "Dia"
                }

            });
        });

    </script>

@endsection
