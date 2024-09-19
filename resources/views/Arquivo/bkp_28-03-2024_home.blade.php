@extends('main')
@section('title', 'Big Brother Plansul')

@section('title2', 'Big Brother Plansul')
@section('content')


    <?php
    use Carbon\Carbon;
    
    $cargo = 'Coord';
    $minhasMoedas = 0;
    $vrfStatusLoja = '';
    $dhHoje = date('d/m/Y H:i:s');
    $hhHoje = date('H:i:s');
    $dtHoje = date('d/m/Y');
    $today = Carbon::today();
    
    ?>
    {{--
<!DOCTYPE html>
<html> --}}

    <head>

        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
        <meta http-equiv="refresh" content="1800">
        <base target="_top" />

        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Big Brother Plansul</title>


        <meta name="description" content="Admin Dashboard Template" />
        <meta name="keywords" content="admin,dashboard" />
        <meta name="author" content="Steelcoders" />

        <script src="{{ asset('assets/plugins/jquery/jquery-2.1.3.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>

        <link href="{{ asset('assets/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/plugins/datatables/buttons/css/buttons.bootstrap.css') }}" rel="stylesheet"
            type="text/css" />
        <link href="{{ asset('assets/plugins/datatables/buttons/css/buttons.bootstrap4.min.css') }}" rel="stylesheet"
            type="text/css" />
        <script src="{{ asset('assets/plugins/bootstrap-notify/bootstrap-notify.js') }}"></script>

        <script src="{{ asset('assets/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/pace-master/pace.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/jquery-blockui/jquery.blockui.js') }}"></script>
        <script src="{{ asset('assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>

        <link href="{{ asset('assets/css/lstProdutos.css') }}" rel="stylesheet" type="text/css" />

        <script>
            var varToken = "{{ csrf_token() }}";
        </script>

        <!-- Styles -->
        <style>
            body {

                /* background: linear-gradient(to right bottom, #ff594b, #ff5652, #ff5358, #ff515f, #ff4f65, #ff4c6b, #ff4a71, #ff4877, #ff447f, #ff4287, #ff3f90, #fe3e99); */
                /*background-image: url("images/sunset.png");*/
                /*background-image: url('/assets/images/Background_BBB.png');*/
                /* background-image: url({{ asset('assets/images/Background_BBB.png') }}); */
                background: #ffffff url({{ asset('assets/images/Background_BBB.png') }}) no-repeat center top;
                background-size: cover;
                background-attachment: fixed;
                overflow-x: hidden;
                height: 100%;
                width: 100%;

                /* BBB-2.webp */

            }

            ul.nav-tabs>li>a {
                color: white;
                border: none;
                border-radius: 4px;
            }

            li.nav-tabs>li>a:hover {
                color: white;
                border: none;
                border-radius: 4px;
                margin-right: 0px;
            }

            ul.menu-nav {
                width: 96%;
                margin-top: 2px;
                display: flex;
                justify-content: center;
                border: none;
            }

            .menu-nav>li>a:hover {
                background: linear-gradient(to right, rgb(251, 74, 110) 0%, rgb(252, 86, 72) 100%);
                border: none;
                color: white;
                border-radius: 4px;
                margin-right: 0px;
            }

            .menu-nav>li.active {
                background: linear-gradient(to right, rgb(251, 74, 110) 0%, rgb(252, 86, 72) 100%) !important;
                border: none;
                border-radius: 3px;
                color: white;
                box-shadow: rgba(0, 0, 0, 0.25) 0px 54px 55px, rgba(0, 0, 0, 0.12) 0px -12px 30px, rgba(0, 0, 0, 0.12) 0px 4px 6px, rgba(0, 0, 0, 0.17) 0px 12px 13px, rgba(0, 0, 0, 0.09) 0px -3px 5px;

            }

            .menu-nav>li.active>a {
                background: none !important;
                border: none !important;
                color: white !important;
            }
        </style>

    </head>

    <body>

        @if (count($adm) == 1)
            <ul class="nav nav-tabs menu-nav">
                <li class="active"><a data-toggle="tab" href="#produtos">Produtos</a></li>
                <li><a data-toggle="tab" href="#gestPontos">Gestão de Pontos</a></li>
                <li><a data-toggle="tab" href="#meusPontos">Meus Pontos</a></li>
                <li><a data-toggle="tab" href="#vencedores">Vencedores</a></li>
            </ul>

            <div class="tab-content item-nav">
                <div id="produtos" class="tab-pane fade in active">
                    @include('listaProdutos')
                </div>
                <div id="gestPontos" class="tab-pane fade">
                    @include('inputPontos')
                </div>
                <div id="meusPontos" class="tab-pane fade">
                    {{-- <h3>Meus Pontos</h3>
                    <p>Conteudo Meus Pontos</p> --}}
                    @include('meusPontos')
                </div>
                <div id="vencedores" class="tab-pane fade">
                    <h3>Vencedores</h3>
                    <p>Conteudo Vencedores</p>
                </div>
            </div>
        @else
            <ul class="nav nav-tabs menu-nav">
                <li class="active"><a data-toggle="tab" href="#produtos">Produtos</a></li>
                <li><a data-toggle="tab" href="#meusPontos">Meus Pontos</a></li>
            </ul>
            <div class="tab-content item-nav">
                <div id="produtos" class="tab-pane fade in active">
                    @include('listaProdutos')
                </div>
                <div id="meusPontos" class="tab-pane fade">
                    @include('meusPontos')
                </div>
            </div>
        @endif

    </body>


    {{-- </html> --}}

@stop
