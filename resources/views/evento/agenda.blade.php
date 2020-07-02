@extends('layouts.index')

@section('container')
    <div class="title">
        <h2>
            <small>Espaço: {{$espaco->nome}}</small>
        </h2>
        @if(Auth::user()->tipo_usuario == 0)
            <a href="{{route('cadastro_evento')}}" class="btn btn-primary">Criar evento</a>
        @else
            <button class="btn btn-primary" data-toggle="modal" data-target="#modalSolicitacao">Solicitar evento</button>
        @endif
    </div>



    <div id="calendar" class="mt-5"></div>

    <form action="{{route('cadastro_evento_data')}}" method="POST" id="form">
        {{ csrf_field() }}
        <input type="hidden" name="data" id="dataF" value=""/>
    </form>

@endsection

@section('modal')
    {{--    MODAL--}}
    <div class="modal" id="modalSolicitacao" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"> </h5>
                    <button type="button" class="close" id="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="col offset-2 mb-5">
                    <h4>Solicitar evento em {{$espaco->nome}}</h4>
                </div>
                <div class="modal-body">
                    <form action="{{route('solicitar_evento', [Auth::user()->id, $espaco->id] )}}" method="POST" id="form">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col mb-3">
                                <label for="Data">Data do evento</label>
                                <input type="date" class="form-control" name="dataSolicitada" id="dataSolicitada"/>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col offset-md-4 mb-3">
                                <button type="submit" class="btn btn-primary btn-lg">Solicitar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{--    FIM MODAL--}}
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
                },

                select: function(start, end, allDay) //criar evento
                {
                    var data = $.fullCalendar.formatDate(start, "DD/MM/Y");

                    @if(Auth::user()->tipo_usuario == 1)
                    //solicitar evento
                    /*var confirmar = confirm("Deseja solicitar um evento na data" + data + "?");
                    if(confirmar)
                    {
                        $('#dataSolicitada').val(data)
                        $("#modalSolicitacao").dialog();

                    }*/
                    @else
                    //criar evento
                    // var confirmar = confirm("Deseja criar um evento na data" + data + "?");
                    // if(confirmar)
                    // {
                    //
                    //
                    // }
                        swal("Deseja criar um evento na data " + data + "?", {
                            buttons: {
                                cancel: "Cancelar",
                                catch: {
                                    text: "Criar Evento",
                                    value: "catch",
                                }
                            },
                        })
                        .then((value) => {
                            switch (value) {
                                case "catch":
                                    $("#dataF").val(data);
                                    jQuery('#form').submit();

                            }
                        });
                    @endif

                },

                eventClick:function(event)
                {
                    var id = event.id;
                    var url = '/evento/' + id;
                    $(location).prop('href', url);
                },

            });
        });

        $(document).ready(function () {
            $("#close").click(function () {
                $("#modalSolicitacao").dialog('close');
            });
        });
    </script>

@endsection
