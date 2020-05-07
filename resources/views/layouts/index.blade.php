<!--
=========================================================
Material Kit - v2.0.7
=========================================================

Product Page: https://www.creative-tim.com/product/material-kit
Copyright 2020 Creative Tim (https://www.creative-tim.com/)

Coded by Creative Tim

=========================================================

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software. -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>
        Feshow
    </title>
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />

{{--  Referencias do template  --}}
<!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    <!-- CSS Files -->
    <link rel="stylesheet" href="{{asset('css/material-kit.css?v=2.0.7')}}">
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link rel="stylesheet" href="{{asset('demo/demo.css')}}">


{{--  Referencias boostrap  --}}
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
</head>

<body class="index-page sidebar-collapse">

@include('layouts.menu')

@if(!empty($mensagem))
    <div class="alert alert-success">
        {{ $mensagem }}
    </div>
@endif

<div class="page-header header-filter clear-filter purple-filter" data-parallax="true" style="background-image: url('./assets/img/bg2.jpg');">
    <div class="container">
        <div class="row">
            <div class="col-md-8 ml-auto mr-auto">
                <div class="brand">
                    <h1>Feshow</h1>
                    <h3>um slogain aí</h3>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="main main-raised">
    <div class="section section-basic">
        <div class="container">
            @yield('container')
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="modalLogin" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"  data-backdrop="static">>
    <div class="modal-dialog modal-login" role="document">
        <div class="modal-content">
            <div class="card card-signup card-plain">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                       <center><h5>Acesse sua conta</h5></center>
                        <hr>
                        <div class="card-body">

                            <div class="form-group bmd-form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="material-icons">email</i>
                                    </span>
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group bmd-form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="material-icons">lock_outline</i>
                                    </span>
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer justify-content-center">
                            <button type="submit" class="btn btn-primary btn-link btn-wd btn-lg"> Entrar</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>


{{--<footer class="footer" data-background-color="black">--}}
{{--    <div class="container">--}}
{{--        <nav class="float-left">--}}
{{--            <ul>--}}
{{--                <li>--}}
{{--                    <a href="https://www.creative-tim.com/">--}}
{{--                        Creative Tim--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--                <li>--}}
{{--                    <a href="https://www.creative-tim.com/presentation">--}}
{{--                        About Us--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--                <li>--}}
{{--                    <a href="https://www.creative-tim.com/blog">--}}
{{--                        Blog--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--                <li>--}}
{{--                    <a href="https://www.creative-tim.com/license">--}}
{{--                        Licenses--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--            </ul>--}}
{{--        </nav>--}}
{{--        <div class="copyright float-right">--}}
{{--            &copy;--}}
{{--            <script>--}}
{{--                document.write(new Date().getFullYear())--}}
{{--            </script>, made with <i class="material-icons">favorite</i> by--}}
{{--            <a href="https://www.creative-tim.com/" target="_blank">Creative Tim</a> for a better web.--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</footer>--}}
<!--   Core JS Files   -->


{{--    Scripts Template--}}
<script src="{{asset('js/core/jquery.min.js')}}" type="text/javascript"></script>
<script src="{{asset('js/core/popper.min.js')}}" type="text/javascript"></script>
<script src="{{asset('js/core/bootstrap-material-design.min.js')}}" type="text/javascript"></script>
<script src="{{asset('js/js/plugins/moment.min.js')}}"></script>
<!--	Plugin for the Datepicker, full documentation here: https://github.com/Eonasdan/bootstrap-datetimepicker -->
<script src="{{asset('js/plugins/bootstrap-datetimepicker.js')}}" type="text/javascript"></script>
<!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
<script src="{{asset('js/plugins/nouislider.min.js')}}" type="text/javascript"></script>
<!--  Google Maps Plugin    -->
<!-- Control Center for Material Kit: parallax effects, scripts for the example pages etc -->
<script src="{{asset('js/material-kit.js?v=2.0.7')}}" type="text/javascript"></script>
<script>
    $(document).ready(function() {
        //init DateTimePickers
        materialKit.initFormExtendedDatetimepickers();

        // Sliders Init
        materialKit.initSliders();
    });


    function scrollToDownload() {
        if ($('.section-download').length != 0) {
            $("html, body").animate({
                scrollTop: $('.section-download').offset().top
            }, 1000);
        }
    }
</script>
<!-- Scripts Bootstrap 4 -->
<script src="{{asset('js/bootstrap.bundle.js')}}"></script>
<script src="{{asset('js/dataTables.bootstrap4.js')}}"></script>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
@yield('scripts_adicionais')
</body>

</html>
