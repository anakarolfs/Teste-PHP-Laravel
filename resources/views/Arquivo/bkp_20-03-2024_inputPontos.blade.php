@extends('main')
@section('title', 'Alteração de Pontuação')

@section('title2', 'Alteração de Pontuação')
@section('content')

    <body>
        <div class="container">
            <div class="titulo">
                <h1>Gestão de pontos</h1>
            </div>
            <div class="conteudo">
                <div id="input-pontos">

                    <label for="matricula-alteracao input-grande">Colaborador(es)</label>
                    <textarea id="matricula-alteracao" name="matricula-alteracao" type="text" placeholder="Insira a(s) matricula(s)."></textarea>

                    <div class="modo">
                        <div class="opcao-modo" id="opcao-modo-creditar">
                            <input id="modo-creditar" class="input-modo" type="radio" name="modo-alteracao"
                                value="1">
                            <label for="modo-creditar">Adicionar pontos</label>
                        </div>
                        <div id="tipo-bonificacao" class="tipo-container">
                        </div>
                        <div class="opcao-modo" id="opcao-modo-debitar">
                            <input id="modo-debitar" class="input-modo" type="radio" name="modo-alteracao" value="0">
                            <label for="modo-debitar">Retirar pontos</label>
                        </div>
                        <div id="tipo-deducao" class="tipo-container">

                        </div>
                    </div>

                    <label for="data-alteracao">Data</label>
                    <input id="data-alteracao" name="data-alteracao" type="date" min="2024-03-11" max="2024-04-30">

                    <label for="descricao-alteracao input-grande">Motivo</label>
                    <textarea id="descricao-alteracao" name="descricao-alteracao" type="text" placeholder="Digite o motivo."></textarea>

                    <button id="enviar" disabled>Enviar</button>
                </div>

                <div id="relatorio-pontos">
                    <div id="grid-resumo">
                    </div>
                </div>
            </div>

        </div>
    </body>

    <script>
        $(document).ready(function() {

            // BUSCA DE TIPOS DE BONIFICAÇÃO E DEDUÇÃO
            buscaTipos();

            // BLOQUEIA CAMPO DE DATA PARA DATAS FUTURAS E ACIMA DE 15 DIAS ANTERIORES
            limitaData();

            // OUVINTE PARA RODAR A VERIFICAÇÃO PARA LIBERAÇÃO DO BOTÃO DE ENVIAR
            $(document).on('change', liberaBotaoEnviar);

            // FORMATA MATRICULAS COM ESPAÇO ENTRE ELAS
            $('#matricula-alteracao').on('keyup', formataMatriculas);

            // BUSCA COLABORADORES LISTADOS E MONTA GRID DE RESUMO COM LISTA DE MATRÍCULAS E NOMES
            $('#matricula-alteracao').on('change', resumoAlteracao);

            // LIBERA INPUTS CORRESPONDENTES AO RADIO SELECIONADO
            $('input[name="modo-alteracao"]').on('change', liberaInputValor);

            //IMPEDE ENTRADA DE CARACTERES NÃO NUMÉRICOS
            $('.valor').on('input', bloqueiaNaoNumericos);

            // IMPEDE DATA DE SER PREENCHIDA PELO TECLADO
            $('#data-alteracao').on('keyup', bloqueiaDigitarData);

            // OUVINTE PARA RODAR ENVIO DAS INFORMAÇÕES
            $('#enviar').on('click', enviaDados);
        });


        // BUSCA DE TIPOS DE BONIFICAÇÃO E DEDUÇÃO
        function buscaTipos() {

            $.ajax({
                url: "{{ route('BuscaTipoBonusDeducao') }}",
                method: 'GET',
                data: {
                    "token": "{{ csrf_token() }}"
                },
                beforeSend: function() {
                    console.log('buscando tipos');
                },
                complete: function() {
                    console.log('finalizada');
                },
                success: function(result) {
                    console.log('busca concluída');
                    console.log(result);

                    var arrayTipoBonus = result.tipoBonus;
                    var arrayTipoDeducao = result.tipoDeducao;

                    arrayTipoBonus.forEach(function(item) {

                        var divOpcaoTipo = $('<div>', {
                            'class': 'opcao-tipo',
                            'id': 'bonus-tipo-' + item.id_tipo_bonificacao
                        });
                        var inputTipoBonificacao = $('<input>', {
                            'type': 'radio',
                            'name': 'tipo-bonificacao',
                            'id': 'tipo-bonificacao-' + item.id_tipo_bonificacao,
                            'value': item.id_tipo_bonificacao
                        });
                        var labelTipoBonificacao = $('<label>', {
                            'for': 'tipo-bonificacao-' + item.id_tipo_bonificacao,
                            'text': item.de_tipo_bonificacao
                        });

                        divOpcaoTipo.append(inputTipoBonificacao, labelTipoBonificacao);

                        $('#tipo-bonificacao').append(divOpcaoTipo);
                    });

                    arrayTipoDeducao.forEach(function(item) {

                        var divOpcaoTipo = $('<div>', {
                            'class': 'opcao-tipo',
                            'id': 'deducao-tipo' + item.id_tipo_deducao
                        });
                        var inputTipoDeducao = $('<input>', {
                            'type': 'radio',
                            'name': 'tipo-deducao',
                            'id': 'tipo-deducao' + item.id_tipo_deducao,
                            'value': item.id_tipo_deducao
                        });
                        var labelTipoDeducao = $('<label>', {
                            'for': 'tipo-deducao' + item.id_tipo_deducao,
                            'text': item.de_tipo_deducao
                        });

                        divOpcaoTipo.append(inputTipoDeducao, labelTipoDeducao);

                        $('#tipo-deducao').append(divOpcaoTipo);
                    });
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    console.log(XMLHttpRequest);
                    console.log(textStatus);
                    console.log(errorThrown);
                    alert('Favor verificar as informações e Tentar novamente');
                }
            });
        };

        // BLOQUEIA CAMPO DE DATA PARA DATAS FUTURAS E ACIMA DE 15 DIAS ANTERIORES
        function limitaData() {

            var dataAtual = new Date();
            var limiteInferior = new Date();

            limiteInferior.setDate(limiteInferior.getDate() - 14);

            var dataAtualFormatada = formataData(dataAtual);
            var limiteInferiorFormatado = formataData(limiteInferior);

            $('#data-alteracao').prop({
                'min': limiteInferiorFormatado,
                'max': dataAtualFormatada
            });
        };

        // MONTA STRING DE DATA NO FORMATO 'YYYY-MM-DD'
        function formataData(data) {

            var ano = data.getFullYear();
            var mes = String(data.getMonth() + 1).padStart(2, '0');
            var dia = String(data.getDate()).padStart(2, '0');

            return `${ano}-${mes}-${dia}`;
        }

        // VERIFICAÇÃO PARA LIBERAÇÃO DO BOTÃO DE ENVIAR
        function liberaBotaoEnviar() {

            if ($('#matricula-alteracao').val() &&
                $('input[name="modo-alteracao"]:checked').val() &&
                ($('input[name="tipo-bonificacao"]:checked').val() || $('input[name="tipo-deducao"]:checked').val()) &&
                $('#data-alteracao').val() &&
                $('#descricao-alteracao').val()
            ) {
                $('#enviar').removeAttr('disabled');
            } else {
                $('#enviar').prop('disabled', true);
            }
        };

        // FORMATA STRING INSERIDA NO INPUT DE MATRICULAS
        function formataMatriculas() {

            var matriculas = $(this).val().replace(/\D/g, '');
            var matriculasFormatadas = matriculas.replace(/(.{6})/g, "$1 ");
            $(this).val(matriculasFormatadas.trim());
        };

        // BUSCA COLABORADORES LISTADOS E MONTA GRID DE RESUMO COM LISTA DE MATRÍCULAS E NOMES
        function resumoAlteracao() {

            var matriculas = $(this).val();
            var arrayMatriculas = matriculas.split(' ');

            $.ajax({
                url: "{{ route('BuscarColaboradores') }}",
                method: 'GET',
                data: {
                    "token": "{{ csrf_token() }}",
                    matricula: arrayMatriculas
                },
                success: function(result) {
                    console.log('sucesso:');
                    console.log(result);

                    if ($('#label-resumo')) {
                        $('#label-resumo').remove();
                    }
                    $('#grid-resumo').empty();

                    var labelResumo = $('<label>', {
                        'id': 'label-resumo',
                        'text': 'Resumo',
                        'css': {
                            'margin-top': '2rem'
                        }
                    });

                    var divHeadMatricula = $('<div>', {
                        'class': 'item-matricula',
                        'text': 'Matricula'
                    });

                    var divHeadNome = $('<div>', {
                        'class': 'item-nome',
                        'text': 'Colaborador'
                    })

                    $('#relatorio-pontos').prepend(labelResumo);
                    $('#grid-resumo').append(divHeadMatricula, divHeadNome);
                    // $('#grid-resumo').append(divHeadNome);

                    result.forEach(function(item) {

                        var divItemMatricula = $('<div>', {
                            'class': 'item-matricula',
                            'text': item.matricula
                        });
                        var divItemNome = $('<div>', {
                            'class': 'item-nome',
                            'text': item.nome
                        });

                        $('#grid-resumo').append(divItemMatricula);
                        $('#grid-resumo').append(divItemNome);
                    });


                },
                error: function() {
                    console.log(XMLHttpRequest);
                    console.log(textStatus);
                    console.log(errorThrown);
                    alert('Favor verificar as informações e Tentar novamente');
                }
            });
        }

        // LIBERA INPUTS CORRESPONDENTES AO RADIO SELECIONADO
        function liberaInputValor() {

            var modo = $('input[name="modo-alteracao"]:checked').val();

            switch (modo) {
                case "0":
                    $('#creditar').prop('disabled', true).val('');
                    $('#debitar').prop('disabled', false);

                    $('#tipo-bonificacao').css('display', 'none');
                    $('#tipo-deducao').css({
                        'display': 'flex',
                        'flex-direction': 'column'
                    });
                    break;
                case "1":
                    $('#creditar').prop('disabled', false);
                    $('#debitar').prop('disabled', true).val('');

                    $('#tipo-bonificacao').css({
                        'display': 'flex',
                        'flex-direction': 'column'
                    });
                    $('#tipo-deducao').css('display', 'none');
                    break;
                default:
                    $('#creditar').prop('disabled', true).val('');
                    $('#debitar').prop('disabled', true).val('');

                    $('#tipo-bonificacao').css('display', 'none');
                    $('#tipo-deducao').css('display', 'none');
                    break;
            }
        }

        // BLOQUEIA CARACTERES NÃO NUMÉRICOS
        function bloqueiaNaoNumericos() {

            $(this).val($(this).val().replace(/[^0-9]/g, ''));
        };

        // BLOQUEIA DIGITAÇÃO DE DATA (DEVE SER ESCOLHIDA NO PRÓPRIO INPUT)
        function bloqueiaDigitarData(event) {

            $(this).val('');
        }

        // ENVIO DAS INFORMAÇÕES
        function enviaDados() {

            var matricula = $('#matricula-alteracao').val();
            var array_matricula = matricula.match(/\b\d{6}\b/g);
            array_matricula.forEach(element => {
                console.log('matricula: ' + element);
            });

            var modo = $('input[name="modo-alteracao"]:checked').val();
            var data = $('#data-alteracao').val();
            var descricao = $('#descricao-alteracao').val();

            if (modo == 0) { //debito

                var tipoDeducao = $('input[name="tipo-deducao"]:checked').val();

                $.ajax({
                    url: "{{ route('SalvarDeducaoExtra') }}",
                    method: 'POST',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        matricula: array_matricula,
                        descricao: descricao,
                        tipo: tipoDeducao,
                        data: data
                    },
                    success: function(result) {
                        console.log('envio concluído');
                        console.log(result);
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown) {
                        console.log(XMLHttpRequest);
                        console.log(textStatus);
                        console.log(errorThrown);
                        alert('Favor verificar as informações e Tentar novamente');
                    }
                });

            } else if (modo == 1) { //bonus

                var tipoBonus = $('input[name="tipo-bonificacao"]:checked').val();

                $.ajax({
                    url: "{{ route('SalvarBonificacaoExtra') }}",
                    method: 'POST',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        matricula: array_matricula,
                        descricao: descricao,
                        tipo: tipoBonus,
                        data: data
                    },
                    success: function(result) {
                        console.log('envio concluído');
                        console.log(result);
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown) {
                        console.log(XMLHttpRequest);
                        console.log(textStatus);
                        console.log(errorThrown);
                        alert('Favor verificar as informações e Tentar novamente');
                    }
                });
            }
        }
    </script>

@stop
