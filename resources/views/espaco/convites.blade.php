@extends('layouts.index')

@section('container')
    @foreach($convites as $convite)
        <div class="caixaArtista">
            {{ $convite->artista }} quer tocar no {{ $convite->evento}}
            <button id='yes'> Aceitar </button>
            <button id='no'> Rejeitar </button>
        </div>
    @endforeach
    
@endsection
@endsection