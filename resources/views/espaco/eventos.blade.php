@extends('layouts.index')

@section('container')
<h2>Eventos abertos:</h2>
    @if(isset($eventos))
        @foreach($eventos as $key => $evento)
            <div class="card" id="{{$key}}" >
                <div class="card-body">
                    <h5 class="card-title">
                        <a href="/evento/{{ $evento->id }}">{{ $evento->nome }}</a> 
                        &nbsp; @ &nbsp;
                        <a href="/espaco/perfil/{{ $espaco->id }}"> {{ $espaco->nome}}</a>
                    </h5>
                    <p> {{$evento->data_inicio}} 
                    @if($evento->data_inicio != $evento->data_fim)
                        - {{ $evento->data_fim }}
                    @endif </p>

                    <p> {{$evento->hora_inicio}} - {{$evento->hora_fim}}</p>

                </div>
            </div>
            
        @endforeach
    @endif

@endsection