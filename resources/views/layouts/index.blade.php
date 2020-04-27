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

    <title>Document</title>
</head>
<body>

@if(!empty($mensagem))
    <div class="alert alert-success">
        {{ $mensagem }}
    </div>
@endif

<div class="jumbotron jumbotron-fluid">
    <div class="container">
        <h1 class="display-4">Feshow</h1>
        <p class="lead">Teste Layout</p>
    </div>
</div>

<div class="container">
    @yield('container')
</div>

<!-- Bootstrap 4 -->
<script src="{{asset('js/bootstrap.bundle.js')}}"></script>
<script src="{{asset('js/dataTables.bootstrap4.js')}}"></script>

</body>
</html>

