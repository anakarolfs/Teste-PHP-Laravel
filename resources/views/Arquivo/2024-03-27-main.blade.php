<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta http-equiv="x-ua-compatible" content="IE=edge;" />
    <base target="_top" />
    <!-- Title -->
    <title>@yield('title')</title>
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta charset="UTF-8">
    <meta name="description" content="Admin Dashboard Template" />
    <meta name="keywords" content="admin,dashboard" />
    <meta name="author" content="Steelcoders" />
    <meta http-equiv="x-ua-compatible" content="IE=edge;" />
    <meta http-equiv="refresh" content="1800">

    <!-- Styles -->
    {{-- <link href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" /> --}}
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" type="text/css" />


    <link href="{{ asset('assets/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/plugins/datatables/buttons/css/buttons.bootstrap.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/plugins/datatables/buttons/css/buttons.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/plugins/datatables/buttons/css/buttons.bootstrap.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/plugins/datatables/buttons/css/buttons.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/main.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/inputPontos.css') }}" rel="stylesheet" type="text/css" />

    <script src="{{ asset('assets/plugins/jquery/jquery-2.1.3.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/jquery-blockui/jquery.blockui.js') }}"></script>
    <script src="{{ asset('assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap-notify/bootstrap-notify.js') }}"></script>
    <script src="{{ asset('assets/plugins/pace-master/pace.min.js') }}"></script>
    <script>
        var varToken = "{{ csrf_token() }}";
    </script>
</head>


<noscript>
    erro!
</noscript>

<body>
    <div class="header">

        <div class="logo">
            <img src="{{ asset('assets/images/Plansul_BBP.png') }}" alt="">
        </div>
        <div class="info-card">

            <div class="nivel">
                <div class="categoria">Nível</div>
                <div id="nivel_atual" class="valor">-</div>
            </div>
            <div id="progresso" class="progresso">
                <div id="label-progresso" class="categoria">Próximo Nível</div>
                <div id="info-xp" class="valor">
                    <div id="nivel_seguinte" class="proximo-nivel">-</div>
                    <div class="barra-progresso">
                        <div id="porcentagem" class="barra-progresso-preenchida"></div>
                    </div>
                    <div class="andamento">
                        <div class="xp">XP</div>
                        <div id="progresso-xp" class="barra-progresso-valores">0/0</div>
                    </div>
                </div>
            </div>
            <div class="crescimento">
                <div class="categoria">Hoje</div>
                <div class="valor">
                    <img src="{{ asset('assets/images/PLANCOIN.png') }}" alt="">
                    <p id="cresc" class="crescimento-valor">+0</p>
                </div>
            </div>
            <div class="montante">
                <div class="categoria">Saldo Disponível</div>
                <div class="valor">
                    <img src="{{ asset('assets/images/plancoins.png') }}" alt="">
                    <p id="total_moedas" class="montante-valor">0</p>
                </div>
            </div>

        </div>

    </div>


    @yield('content')
</body>

<script>
    $(document).ready(function() {
        preencheMainHeader();
    });

    function preencheMainHeader() {
        $.ajax({
            url: "{{ route('buscar-saldo') }}",
            method: "GET",
            data: {
                _token: "{{ csrf_token() }}",
            },
            success: function(result) {
                $("#nivel_atual").text(result["nivel_atual"]);
                $("#nivel_seguinte").text(result["nivel_seguinte"]);
                if (result["nivel_seguinte"] == '') {
                    $('#label-progresso').css('display', 'none');
                    $('#progresso').css('justify-content', 'center').css('align-items', 'center').css(
                        'font-size', '20px').text(result[
                        "progresso_final"]);
                } else {
                    $("#progresso-xp").text(result["progresso_atual"] + "/" + result["progresso_final"]);
                }
                $("#porcentagem").css("width", result["porcentagem"] + "%");

                $("#total_moedas").text(result["total_moedas"]);

                if (result["cresc"] > 0) {
                    $("#cresc")
                        .text("+" + result["cresc"])
                        .css("color", "rgb(0, 88, 0)");
                } else if (result["cresc"] < 0) {
                    $("#cresc").text(result["cresc"]).css("color", "red");
                } else {
                    $("#cresc")
                        .text("+" + result["cresc"])
                        .css("color", "white");
                }

                $(".info-card").css("font-family", "Trebuchet MS");
            },
        });
    }
</script>
