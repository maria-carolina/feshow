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

{{--    Referencias para o FullCalendar--}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/css/bootstrap.css" />

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

        label {
            color: black;
        }
    </style>
</head>

<body>
@yield('body')

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

{{--    Referencias para o FullCalendar--}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>

@yield('scripts_adicionais')
</body>

</html>
