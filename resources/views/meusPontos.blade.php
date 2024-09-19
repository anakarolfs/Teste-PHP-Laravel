<style>
    #meus-pontos {
        /* padding: 5px; */
        display: flex;
        flex-direction: column;
        justify-content: center;
        /* background-color: rgba(0, 30, 95, 1); */
        background-color: rgba(15, 47, 116, 1);
        /* background: linear-gradient(to right, rgb(0, 30, 95) 0%, rgb(0, 70, 135) 100%); */
        /* background: linear-gradient(to right, rgb(251, 74, 110) 0%, rgb(252, 86, 72) 100%); */
        border-radius: 5px;
        box-shadow: rgba(0, 0, 0, 0.25) 0px 54px 55px, rgba(0, 0, 0, 0.12) 0px -12px 30px, rgba(0, 0, 0, 0.12) 0px 4px 6px, rgba(0, 0, 0, 0.17) 0px 12px 13px, rgba(0, 0, 0, 0.09) 0px -3px 5px;
    }

    .titulo-filtro-container {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    #titulo>h1 {
        color: white;
    }

    .label-filtro {
        color: white;
        margin: 0px 10px 0px 30px;
    }

    .input-filtro-data {
        /* background-color: rgb(251, 74, 110); */
        /* background: linear-gradient(to right, rgb(251, 74, 110) 0%, rgb(252, 86, 72) 100%); */
        background: linear-gradient(to right, rgb(220, 220, 220) 0%, rgb(255, 255, 255) 100%);
        height: 30px;
        color: white;
        color: rgb(15, 47, 116);
        border: 1px solid white;
        border: none;
        border-radius: 3px;
        box-shadow: rgba(0, 0, 0, 0.25) 0px 54px 55px, rgba(0, 0, 0, 0.12) 0px -12px 30px, rgba(0, 0, 0, 0.12) 0px 4px 6px, rgba(0, 0, 0, 0.17) 0px 12px 13px, rgba(0, 0, 0, 0.09) 0px -3px 5px;
    }

    #filtrar {
        margin-left: 11px;
        height: 30px;
        width: 70px;
        /* background: linear-gradient(to right, rgb(251, 74, 110) 0%, rgb(252, 86, 72) 100%); */
        background: linear-gradient(to right, rgb(220, 220, 220) 0%, rgb(255, 255, 255) 100%);
        color: rgb(15, 47, 116);
        border: 1px solid white;
        border: none;
        border-radius: 3px;
        box-shadow: rgba(0, 0, 0, 0.25) 0px 54px 55px, rgba(0, 0, 0, 0.12) 0px -12px 30px, rgba(0, 0, 0, 0.12) 0px 4px 6px, rgba(0, 0, 0, 0.17) 0px 12px 13px, rgba(0, 0, 0, 0.09) 0px -3px 5px;
    }

    #filtrar:disabled {
        background: linear-gradient(to right, rgb(120, 120, 120) 0%, rgb(155, 155, 155) 100%);
    }

    .tabela {
        margin-bottom: 15px;
        padding: 3px;
        width: 100%;
        height: auto;
        border-radius: 5px;
        background-color: rgba(0, 30, 95, 1);
        display: grid;
        grid-template-columns: repeat(12, minmax(10px, 1fr));
        /*  */
        grid-template-rows: auto;
        gap: 1px;
    }

    .item-tabela {
        height: 30px;
        display: flex;
        justify-content: center;
        align-items: center;
        /* background-color: rgba(252, 86, 72, 0.5); */
        /* background: linear-gradient(to right, rgb(251, 74, 110) 0%, rgb(252, 86, 72) 100%); */
        color: white;
        border-radius: 2px;
    }

    .cabecalho {
        font-size: 1.1rem;
        font-weight: 500;
        border-bottom: 0.1rem solid white;
        /* background: linear-gradient(to right, rgb(251, 74, 110) 0%, rgb(252, 86, 72) 100%); */
    }

    @media {}
</style>

<div id="meus-pontos" class="container">
    <div class="titulo-filtro-container">
        <div id="titulo"> {{-- class="titulo" --}}
            <h1>Meus Pontos</h1>
        </div>
        <div class="filtro-data">
            <label for="data-inicio" class="label-filtro">Início:</label>
            <input type="date" name="data-inicio" class="input-filtro-data" id="data-inicio" min="2024-01-01"
                max="2024-12-31">
            <label for="data-fim" class="label-filtro">Fim:</label>
            <input type="date" name="data-fim" class="input-filtro-data" id="data-fim" min="2024-01-01"
                max="2024-12-31">
            <button id="filtrar" disabled>Buscar</button>
        </div>
    </div>
    <div class="tabela" id="tabela-extrato">
        <div class="item-tabela cabecalho item-data">Data</div>
        <div class="item-tabela cabecalho item-nivel">Nível</div>
        <div class="item-tabela cabecalho item-1">Hora Extra</div>
        <div class="item-tabela cabecalho item-2">TMA</div>
        <div class="item-tabela cabecalho item-3">Elogios</div>
        <div class="item-tabela cabecalho item-4">F. Justificada</div>
        <div class="item-tabela cabecalho item-5">F. Injustificada</div>
        <div class="item-tabela cabecalho item-6">F. Postural</div>
        <div class="item-tabela cabecalho item-7">Glosa</div>
        <div class="item-tabela cabecalho item-8">Compras</div>
        <div class="item-tabela cabecalho item-total">Total</div>
        <div class="item-tabela cabecalho item-obs">Observações</div>
        {{-- data 1 --}}
        <div class="item-tabela item-data">25/03/2024</div>
        <div class="item-tabela item-nivel"></div>
        <div class="item-tabela item-1"></div>
        <div class="item-tabela item-2"></div>
        <div class="item-tabela item-3"></div>
        <div class="item-tabela item-4"></div>
        <div class="item-tabela item-5"></div>
        <div class="item-tabela item-6"></div>
        <div class="item-tabela item-7"></div>
        <div class="item-tabela item-8"></div>
        <div class="item-tabela item-total"></div>
        <div class="item-tabela item-obs"></div>

    </div>
</div>

<script>
    $(document).ready(function() {

        // BLOQUEIA CAMPO DE DATA PARA DATAS FUTURAS E ACIMA DE 15 DIAS ANTERIORES
        limitaFiltroData();

        // BUSCAR EXTRATO DE PONTOS DO OPERADOR
        buscaExtratoPontos();

        // IMPEDE DATA DE SER PREENCHIDA PELO TECLADO
        $('#data-inicio').on('keyup', bloqueiaDigitarData);
        $('#data-fim').on('keyup', bloqueiaDigitarData);

        // LIBERAR BOTÃO DE FILTRAR APENAS APÓS OS DOIS CAMPOS ESTAREM PREENCHIDOS
        $('#data-inicio').on('change', liberaBotaoFiltrar);
        $('#data-fim').on('change', liberaBotaoFiltrar);

        //APLICAR FILTRO DE DATA NO EXTRATO
        $('#filtrar').on('click', filtraExtratoPontos);
    });

    function liberaBotaoFiltrar() {

        if ($('#data-inicio').val() && $('#data-fim').val()) {
            $('#filtrar').removeAttr('disabled');
        } else {
            $('#filtrar').prop('disabled', true);
        }
    }

    // BLOQUEIA CAMPO DE DATA PARA DATAS FUTURAS E ACIMA DE 15 DIAS ANTERIORES
    function limitaFiltroData() {

        var dataOntem = new Date();
        var limiteInferior = new Date();

        dataOntem.setDate(dataOntem.getDate() - 1);
        limiteInferior.setDate(limiteInferior.getDate() - 30);

        var dataOntemFormatada = formataData(dataOntem);
        var limiteInferiorFormatado = formataData(limiteInferior);

        $('.input-filtro-data').prop({
            'min': limiteInferiorFormatado,
            'max': dataOntemFormatada
        });
    };

    // MONTA STRING DE DATA NO FORMATO 'YYYY-MM-DD'
    function formataData(data) {

        var ano = data.getFullYear();
        var mes = String(data.getMonth() + 1).padStart(2, '0');
        var dia = String(data.getDate()).padStart(2, '0');

        return `${ano}-${mes}-${dia}`;
    };

    // MONTA STRING DE DATA NO FORMATO 'DD-MM-YYYY'
    function formataDataUI(data) {

        data = new Date(data);
        var ano = data.getUTCFullYear();
        var mes = String(data.getUTCMonth() + 1).padStart(2, '0');
        var dia = String(data.getUTCDate()).padStart(2, '0');

        return `${dia}/${mes}/${ano}`;
    };

    // BLOQUEIA DIGITAÇÃO DE DATA (DEVE SER ESCOLHIDA NO PRÓPRIO INPUT)
    function bloqueiaDigitarData(event) {

        $(this).val('');
        Swal.fire({
            title: 'Selecione a data através da lista!',
            icon: 'error',
            text: 'Para isso, clique no ícone de calendário.',
            showConfirmButton: true,
            confirmButtonText: 'OK',
            showCancelButton: false,
            allowOutsideClick: false,
            confirmButtonColor: '#fb4a6e'
        });
    }

    function buscaExtratoPontos() {

        $.ajax({
            url: "{{ route('BuscarExtratoPontos') }}",
            method: 'GET',
            data: {
                _token: "{{ csrf_token() }}"
            },
            success: function(result) {
                // LIMPA DADOS ATUAIS DA TABELA
                $('#tabela-extrato').empty();
                // REMONTA O CABEÇALHO DA TABELA
                montaCabecalhoGrid();
                // MONTA CADA LINHA DA TABELA
                result.forEach(function(item) {

                    var dataFormatada = item.data ? formataDataUI(item.data) : '';
                    var nivel = item.moedas_nivel ? item.moedas_nivel : 0;
                    var horaExtra = item.hora_extra ? item.hora_extra : 0;
                    var tma = item.tma ? item.tma : 0;
                    var elogio = item.elogios ? item.elogios : 0;
                    var fJust = item.falta_justificada ? item.falta_justificada : 0;
                    var fInjust = item.falta_injustificada ? item.falta_injustificada : 0;
                    var fPost = item.falta_postural ? item.falta_postural : 0;
                    var glosa = item.glosa_de_qualidade ? item.glosa_de_qualidade : 0;
                    var compra = item.compras_dia ? item.compras_dia : 0;
                    var total = (
                        nivel +
                        horaExtra +
                        tma +
                        elogio +
                        fJust +
                        fInjust +
                        fPost +
                        glosa +
                        compra
                    );

                    var divItemData = $('<div>', {
                        'class': 'item-tabela item-data'
                    }).text(dataFormatada);
                    var divItemNivel = criaCelulaGrid(nivel, 'nivel');
                    var divItemHE = criaCelulaGrid(horaExtra, 'horaExtra');
                    var divItemTMA = criaCelulaGrid(tma, 'tma');
                    var divItemElogio = criaCelulaGrid(elogio, 'elogio');
                    var divItemFJ = criaCelulaGrid(fJust, 'fJust');
                    var divItemFI = criaCelulaGrid(fInjust, 'fInjust');
                    var divItemFP = criaCelulaGrid(fPost, 'fPost');
                    var divItemGlosa = criaCelulaGrid(glosa, 'glosa');
                    var divItemCompra = criaCelulaGrid(compra, 'compra');
                    var divItemTotal = criaCelulaGrid(total, 'total');
                    var divItemObs = $('<div>', {
                        'class': 'item-tabela item-obs'
                    })

                    $('#tabela-extrato').append(
                        divItemData,
                        divItemNivel,
                        divItemHE,
                        divItemTMA,
                        divItemElogio,
                        divItemFJ,
                        divItemFI,
                        divItemFP,
                        divItemGlosa,
                        divItemCompra,
                        divItemTotal,
                        divItemObs
                    );
                });
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                console.log(XMLHttpRequest);
                console.log(textStatus);
                console.log(errorThrown);

                Swal.fire({
                    title: 'Algo deu errado!',
                    icon: 'error',
                    showConfirmButton: true,
                    confirmButtonText: 'OK',
                    showCancelButton: false,
                    allowOutsideClick: false,
                    confirmButtonColor: '#fb4a6e'
                });
            }
        });
    };

    function filtraExtratoPontos() {

        var dt_inicio = $('#data-inicio').val();
        var dt_fim = $('#data-fim').val();

        $.ajax({
            url: "{{ route('FiltrarExtratoPontos') }}",
            method: 'GET',
            data: {
                _token: "{{ csrf_token() }}",
                dt_inicio: dt_inicio,
                dt_fim: dt_fim
            },
            success: function(result) {
                // LIMPA DADOS ATUAIS DA TABELA
                $('#tabela-extrato').empty();
                // REMONTA O CABEÇALHO DA TABELA
                montaCabecalhoGrid();
                // MONTA CADA LINHA DA TABELA
                result.forEach(function(item) {

                    var dataFormatada = item.data ? formataDataUI(item.data) : '';
                    var nivel = item.moedas_nivel ? item.moedas_nivel : 0;
                    var horaExtra = item.hora_extra ? item.hora_extra : 0;
                    var tma = item.tma ? item.tma : 0;
                    var elogio = item.elogios ? item.elogios : 0;
                    var fJust = item.falta_justificada ? item.falta_justificada : 0;
                    var fInjust = item.falta_injustificada ? item.falta_injustificada : 0;
                    var fPost = item.falta_postural ? item.falta_postural : 0;
                    var glosa = item.glosa_de_qualidade ? item.glosa_de_qualidade : 0;
                    var compra = item.compras_dia ? item.compras_dia : 0;
                    var total = (
                        nivel +
                        horaExtra +
                        tma +
                        elogio +
                        fJust +
                        fInjust +
                        fPost +
                        glosa +
                        compra
                    );

                    var divItemData = $('<div>', {
                        'class': 'item-tabela item-data'
                    }).text(dataFormatada);
                    var divItemNivel = criaCelulaGrid(nivel, 'nivel');
                    var divItemHE = criaCelulaGrid(horaExtra, 'horaExtra');
                    var divItemTMA = criaCelulaGrid(tma, 'tma');
                    var divItemElogio = criaCelulaGrid(elogio, 'elogio');
                    var divItemFJ = criaCelulaGrid(fJust, 'fJust');
                    var divItemFI = criaCelulaGrid(fInjust, 'fInjust');
                    var divItemFP = criaCelulaGrid(fPost, 'fPost');
                    var divItemGlosa = criaCelulaGrid(glosa, 'glosa');
                    var divItemCompra = criaCelulaGrid(compra, 'compra');
                    var divItemTotal = criaCelulaGrid(total, 'total');
                    var divItemObs = $('<div>', {
                        'class': 'item-tabela item-obs'
                    })

                    $('#tabela-extrato').append(
                        divItemData,
                        divItemNivel,
                        divItemHE,
                        divItemTMA,
                        divItemElogio,
                        divItemFJ,
                        divItemFI,
                        divItemFP,
                        divItemGlosa,
                        divItemCompra,
                        divItemTotal,
                        divItemObs
                    );
                });
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                console.log(XMLHttpRequest);
                console.log(textStatus);
                console.log(errorThrown);

                Swal.fire({
                    title: 'Algo deu errado!',
                    icon: 'error',
                    showConfirmButton: true,
                    confirmButtonText: 'OK',
                    showCancelButton: false,
                    allowOutsideClick: false,
                    confirmButtonColor: '#fb4a6e'
                });
            }
        })
    }

    function montaCabecalhoGrid() {

        var divItemDataCabecalho = $('<div>', {
            'class': 'item-tabela cabecalho'
        }).text('Data');
        var divItemNivelCabecalho = $('<div>', {
            'class': 'item-tabela cabecalho'
        }).text('Nível');
        var divItemHECabecalho = $('<div>', {
            'class': 'item-tabela cabecalho'
        }).text('Hora Extra');
        var divItemTMACabecalho = $('<div>', {
            'class': 'item-tabela cabecalho'
        }).text('TMA');
        var divItemElogioCabecalho = $('<div>', {
            'class': 'item-tabela cabecalho'
        }).text('Elogios');
        var divItemFJCabecalho = $('<div>', {
            'class': 'item-tabela cabecalho'
        }).text('F. Justificada');
        var divItemFICabecalho = $('<div>', {
            'class': 'item-tabela cabecalho'
        }).text('F. Injustificada');
        var divItemFPCabecalho = $('<div>', {
            'class': 'item-tabela cabecalho'
        }).text('F. Postural');
        var divItemGlosaCabecalho = $('<div>', {
            'class': 'item-tabela cabecalho'
        }).text('Glosa');
        var divItemCompraCabecalho = $('<div>', {
            'class': 'item-tabela cabecalho'
        }).text('Compras');
        var divItemTotalCabecalho = $('<div>', {
            'class': 'item-tabela cabecalho'
        }).text('Total');
        var divItemObsCabecalho = $('<div>', {
            'class': 'item-tabela cabecalho'
        }).text('Observações');

        $('#tabela-extrato').append(
            divItemDataCabecalho,
            divItemNivelCabecalho,
            divItemHECabecalho,
            divItemTMACabecalho,
            divItemElogioCabecalho,
            divItemFJCabecalho,
            divItemFICabecalho,
            divItemFPCabecalho,
            divItemGlosaCabecalho,
            divItemCompraCabecalho,
            divItemTotalCabecalho,
            divItemObsCabecalho
        );
    }

    function criaCelulaGrid(val, itemClass) {

        let bonus = ['nivel', 'horaExtra', 'tma', 'elogio'];
        let deducao = ['fJust', 'fInjust', 'fPost', 'glosa', 'compra'];

        if (bonus.includes(itemClass)) {

            if (val !== 0) {

                var divItem = $('<div>', {
                    'class': 'item-tabela',
                    'css': {
                        'display': 'flex',
                        'justify-content': 'center'
                    }
                });
                // var divImgPlancoins = $('<div>');
                var divVal = $('<div>', {
                    'css': {
                        // 'color': 'green'
                        'color': 'white',
                        'font-weight': '700'
                    }
                });
                // var imgPlancoins = $('<img>', {
                //     'src': '{{ asset('assets/images/plancoins.png') }}',
                //     'css': {
                //         'width': '25px',
                //         'margin-right': '5px'
                //     }
                // });
                // divImgPlancoins.append(imgPlancoins);
                divVal.text('+' + val);
                // divItem.append(divImgPlancoins, divVal);
                divItem.append(divVal);

            } else {
                var divItem = $('<div>', {
                    'class': 'item-tabela',
                    'text': '-'
                });
            }
        } else if (deducao.includes(itemClass)) {

            if (val !== 0) {

                var divItem = $('<div>', {
                    'class': 'item-tabela',
                    'css': {
                        'display': 'flex',
                        'justify-content': 'center'
                    }
                });
                // var divImgPlancoins = $('<div>');
                var divVal = $('<div>', {
                    'css': {
                        // 'color': 'red'
                        'color': 'white',
                        'font-weight': '700'
                    }
                });
                // var imgPlancoins = $('<img>', {
                //     'src': '{{ asset('assets/images/plancoins.png') }}',
                //     'css': {
                //         'width': '25px',
                //         'margin-right': '5px'
                //     }
                // });
                // divImgPlancoins.append(imgPlancoins);
                divVal.text(val);
                // divItem.append(divImgPlancoins, divVal);
                divItem.append(divVal);

            } else {
                var divItem = $('<div>', {
                    'class': 'item-tabela',
                    'text': '-'
                });
            }
        } else if (itemClass == 'total') {

            if (val > 0) {

                var divItem = $('<div>', {
                    'class': 'item-tabela',
                    'css': {
                        'display': 'flex',
                        'justify-content': 'center'
                    }
                });
                // var divImgPlancoins = $('<div>');
                var divVal = $('<div>', {
                    'css': {
                        // 'color': 'green'
                        'color': 'white',
                        'font-weight': '700'
                    }
                });
                // var imgPlancoins = $('<img>', {
                //     'src': '{{ asset('assets/images/plancoins.png') }}',
                //     'css': {
                //         'width': '25px',
                //         'margin-right': '5px'
                //     }
                // });
                // divImgPlancoins.append(imgPlancoins);
                divVal.text('+' + val);
                // divItem.append(divImgPlancoins, divVal);
                divItem.append(divVal);

            } else if (val < 0) {

                var divItem = $('<div>', {
                    'class': 'item-tabela',
                    'css': {
                        'display': 'flex',
                        'justify-content': 'center'
                    }
                });
                var divImgPlancoins = $('<div>');
                var divVal = $('<div>', {
                    'css': {
                        // 'color': 'red',
                        'color': 'white',
                        'font-weight': '700'
                    }
                });
                // var imgPlancoins = $('<img>', {
                //     'src': '{{ asset('assets/images/plancoins.png') }}',
                //     'css': {
                //         'width': '25px',
                //         'margin-right': '5px'
                //     }
                // });
                // divImgPlancoins.append(imgPlancoins);
                divVal.text(val);
                // divItem.append(divImgPlancoins, divVal);
                divItem.append(divVal);

            } else {

                var divItem = $('<div>', {
                    'class': 'item-tabela',
                    'text': '-'
                });
            }
        }
        return divItem;
    }
</script>
