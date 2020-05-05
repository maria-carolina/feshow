<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('css/fontawesome.css')}}">
    @yield('links_adicionais')
    <style>
        body{
            font-family: arial;
        }
        button#dropdownMenuButton {
            position:absolute;
            right: 0px;
            top: 0px;
        }

        div#jumbotron, div#perfil {
            position: relative;
        }

        div.caixaArtista {
            position: relative;
            width: 600px;
            height: 150px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-top: 15px;
            margin-bottom: 30px;
        }

        div.caixaArtista p{
            font-size: 16pt;
            top:20px;
            position: absolute;
        
        }

        div.caixaArtista h1{
            font-size: 24pt;
            top: 0px;
            position: absolute;
            text-align: center;
        }

        div.caixaArtista button{
            position: absolute;
            bottom: 5px;
        }

        div.caixaArtista button#yes{
            right:52%;
        }

        div.caixaArtista button#no{
            left:52%;
        }


        h2#cinza {
            color: #adad85;
            font-size: 16pt;
        }

        p{
            margin-top: 20px;
        }

        ul{
            list-style: none;
            padding: 0;
        }

        ul#nome_generos li{
            display: inline-block;
         }

        ul#outras_infos li {
            font-size: 10pt;
        }

        ul#data_horario {
            position: absolute;
            right: 0px;
            top: 0px;
        }
        ul#data_horario li {
            font-size: 20pt;
        }

    </style>
    <title>Document</title>
</head>
<body>

@if(!empty($mensagem))
    <div class="alert alert-success">
        {{ $mensagem }}
    </div>
@endif

<div class="jumbotron jumbotron-fluid position-relative" id="jumbotron">
    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Nome
    </button>
    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
        <a class="dropdown-item" href="#">Action</a>
        <a class="dropdown-item" href="#">Another action</a>
        <a class="dropdown-item" href="#">Something else here</a>
    </div>
    <div class="container">
        <h1 class="display-4">Feshow</h1>
        <p class="lead">Teste Layout</p>
    </div>

</div>

<div class="container">
    @include('layouts.erros')
    @yield('container')
</div>

<!-- Bootstrap 4 -->
<script src="{{asset('js/bootstrap.bundle.js')}}"></script>
<script src="{{asset('js/dataTables.bootstrap4.js')}}"></script>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
@yield('scripts_adicionais')
</body>
</html>

