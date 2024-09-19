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

        <div id="logo" class="logo">
            <img src="{{ asset('assets/images/Plansul_BBP.png') }}" alt="">
        </div>
        <div id="nivelador" hidden style="height: 170px"></div>
        <div id="info-card" class="info-card">

            <div id="nivel" class="nivel">
                <div id="label-nivel" class="categoria">Nível</div>
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
                        <div id="label-xp" class="xp">XP</div>
                        <div id="progresso-xp" class="barra-progresso-valores">0/0</div>
                    </div>
                </div>
            </div>
            <div id="crescimento" class="crescimento">
                <div id="label-Hoje" class="categoria">Hoje</div>
                <div class="valor">
                    <img src="{{ asset('assets/images/PLANCOIN.png') }}" alt="">
                    <p id="cresc" class="crescimento-valor">+0</p>
                </div>
            </div>
            <div id="montante" class="montante">
                <div id="label-total" class="categoria">Saldo Disponível</div>
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

        var ultimaAlturaDoScroll = 230

        window.addEventListener('scroll', function() {

            var alturaDoScroll = window.pageYOffset || document.documentElement.scrollTop || document
                .body
                .scrollTop || 0;

            if (alturaDoScroll > 230) {

                $('#info-card').css('transition', 'width 0.5s, height 0.5s')
                    .css('padding', '0 0')
                    .css('height', '60px')
                    .css('position', 'fixed')
                    .css('margin-top', '10px')
                    .css('z-index', 2);

                $('#nivelador').attr('hidden', false);

                $('#label-nivel').attr('hidden', true);
                $('#label-progresso').attr('hidden', true);
                $('#label-xp').attr('hidden', true);
                $('#label-Hoje').attr('hidden', true);
                $('#label-total').attr('hidden', true);

                $('#nivel').css('display', 'flex')
                    .css('justify-content', 'center')
                    .css('align-items', 'center')

                $('#crescimento').css('display', 'flex')
                    .css('justify-content', 'center')
                    .css('align-items', 'center')
                    .css('font-size', '24px');

                $('#montante').css('display', 'flex')
                    .css('justify-content', 'center')
                    .css('align-items', 'center')
                    .css('font-size', '24px');

                $('#progresso').css('display', 'flex')
                    .css('justify-content', 'center')
                    .css('align-items', 'center');

            } else {

                $('#info-card').css('transition', 'width 0.5s, height 0.5s')
                    .css('padding', '50px 30px')
                    .css('height', '170px')
                    .css('position', 'unset')
                    .css('margin-top', 'unset')
                    .css('z-index', 0);

                $('#nivelador').attr('hidden', true);

                $('#label-nivel').attr('hidden', false);
                $('#label-progresso').attr('hidden', false);
                $('#label-xp').attr('hidden', false);
                $('#label-Hoje').attr('hidden', false);
                $('#label-total').attr('hidden', false);

                let nivel = $("#nivel_seguinte").val();

                if (nivel == '') {
                    $('#nivel').css('display', 'flex')
                        .css('justify-content', 'center')
                        .css('align-items', 'center')

                } else {
                    $('#nivel').css('display', 'unset')
                        .css('justify-content', 'unset')
                        .css('align-items', 'unset');
                }

                $('#nivel').css('display', 'unset')
                    .css('justify-content', 'unset')
                    .css('align-items', 'unset');

                $('#crescimento').css('display', 'unset')
                    .css('justify-content', 'unset')
                    .css('align-items', 'unset')
                    .css('font-size', 'unset');

                $('#montante').css('display', 'unset')
                    .css('justify-content', 'unset')
                    .css('align-items', 'unset')
                    .css('font-size', 'unset');

                $('#progresso').css('display', 'unset')
                    .css('justify-content', 'unset')
                    .css('align-items', 'unset');

            }

        });

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

                    $('#nivel').css('display', 'flex')
                        .css('justify-content', 'center')
                        .css('align-items', 'center')

                } else {

                    $('#nivel').css('display', 'unset')
                        .css('justify-content', 'unset')
                        .css('align-items', 'unset');

                    $("#progresso-xp").text(result["progresso_atual"] + "/" + result["progresso_final"]);
                }
                $("#porcentagem").css("width", result["porcentagem"] + "%");

                $("#total_moedas").text(result["total_moedas"]);

                if (result["cresc"] > 0) {
                    $("#cresc")
                        .text("+" + result["cresc"])
                        .css("color", "#f6c643");
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
