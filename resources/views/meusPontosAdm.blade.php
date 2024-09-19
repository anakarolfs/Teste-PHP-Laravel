<style>
    #meus-pontos-adm {
        width: 96vw;
        display: flex;
        flex-direction: column;
        justify-content: center;
        background-color: rgba(15, 47, 116, 1);
        border-radius: 5px;
        box-shadow: rgba(0, 0, 0, 0.25) 0px 54px 55px, rgba(0, 0, 0, 0.12) 0px -12px 30px, rgba(0, 0, 0, 0.12) 0px 4px 6px, rgba(0, 0, 0, 0.17) 0px 12px 13px, rgba(0, 0, 0, 0.09) 0px -3px 5px;
        font-size: 10px;
    }

    #tabela-pontos {
        margin-bottom: 15px;
        padding: 3px;
        width: 100%;
        height: auto;
        border-radius: 5px;
        background-color: rgba(0, 30, 95, 1);
        color: white;
        overflow-x: auto;
    }

    #tabela-pontos .table-col-adm-nome {
        margin: 0px 5px;
        font-size: 10px;
        font-weight: 100;
        text-align: start;
        position: relative;
        left: 10px;
    }

    #tabela-pontos .table-col-adm {
        margin: 0px 5px;
        font-size: 10px;
        font-weight: 100;
        text-align: center;
    }

    #tabela-pontos th.sorting {
        border-bottom: 1px solid white;
        font-size: 12px;
    }

    .filtros-datatables {
        align-items: baseline;
    }

    #titulo>h1 {
        color: white;
        margin-right: 10px;
    }

    #opcoes-tabela-acima {
        display: flex;
        flex-grow: 1;
        align-items: baseline;
        justify-content: flex-end;
    }

    #opcoes-tabela-acima>div {
        margin: 10px;
    }

    #tabela-pontos_length {
        display: flex;
        align-items: center;
        justify-content: start;
    }

    #tabela-pontos_length>label {
        color: white;
        margin: 0px 3px;
        position: relative;
        top: 19px;
    }

    #tabela-pontos_length>label>select[name='tabela-pontos_length'] {
        /* margin: 0px 2px;
        padding: 0px 1px;
        height: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(to right, rgb(220, 220, 220) 0%, rgb(255, 255, 255) 100%);
        color: rgb(15, 47, 116);
        border: none;
        border-radius: 3px; */
        font-family: inherit;
        font-size: inherit;
        line-height: inherit;
        background-color: #001e5f;
        border-radius: 5px;
        border-color: #0d2d71;
    }


    #tabela-pontos_filter {
        display: flex;
        align-items: center;
        justify-content: end;
        margin-bottom: 10px;
    }

    #tabela-pontos_filter>label {
        color: white;
        margin: 0px 3px;
        gap: 10px;
        display: flex;
        align-items: center;
    }

    #tabela-pontos_filter>label>input[type="search"] {

        border-radius: 5px;
        background-color: #001e5f;
        color: #fff;
        border-color: #0e2e73;
    }


    #opcoes-tabela-abaixo {
        width: 100%;
        display: flex;
        align-items: baseline;
        justify-content: space-between;
    }

    #tabela-pontos_info {
        font-size: 15px;
        color: #ffffff
    }

    #tabela-pontos_paginate {
        display: flex;
        margin: 0px 13px 15px 15px;
        display: flex;
        margin: 0px 13px 15px 15px;
        align-items: center;
        justify-content: end;
        position: relative;
        bottom: 20px;
    }

    #tabela-pontos_paginate>span {
        display: flex;
    }

    .paginate_button {
        background: none !important;
        border-radius: 3px !important;
        color: #fff !important;
        background-color: #001e5f !important;
        border-color: #0d2b6a !important;
    }

    #meus-pontos-adm {
        position: relative;
    }

    #loading-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(255, 255, 255, 0.8);
        /* Cor de fundo semi-transparente */
        display: none;
        z-index: 1;
        border-radius: 5px;
        font-size: 24px
    }

    #loading-message {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }
</style>

<div id="meus-pontos-adm" class="container">
    <div id="loading-overlay">
        <div id="loading-message">Carregando aguarde um momento...</div>
    </div>
    <div class="titulo-filtro-container filtros-datatables">
        <div id="titulo"> {{-- class="titulo" --}}
            <h1>Pontos Gerais</h1>
        </div>
        <div id="opcoes-tabela-acima"></div>
    </div>
    <table id="tabela-pontos" style="width: 100%;">
        <thead>
            <tr>
            </tr>
        </thead>
        <tbody>

        </tbody>
    </table>
    <div id="opcoes-tabela-abaixo"></div>
</div>

{{-- <!--<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>--> --}}
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">


<script>
    var tabelaADM = null

    $(document).ready(function() {

        var tabelaADM = $('#tabela-pontos').DataTable({
            data: [],
            dom: 'Brlftipr',
            buttons: [{
                extend: 'excel', // Excel export button
                text: 'Exportar para Excel' // Button text
            }],
            pagingType: 'full_numbers',
            language: {
                url: "assets/js/datatablesPT.json",
            },
            columns: [{
                    data: "nome_usuario",
                    title: "Nome",
                    className: 'table-col-adm-nome',
                    width: 400,
                    render: function(data) {
                        return data ? data : '-';
                    }
                },
                {
                    data: "mat_usuario",
                    title: "Matrícula",
                    className: 'table-col-adm',
                    render: function(data) {
                        return data ? data : '-';
                    }
                },
                {
                    data: "total_moedas",
                    title: "Total Moedas",
                    className: 'table-col-adm',
                    render: function(data) {
                        return data ? data : '-';
                    }
                },
                {
                    data: "nivel_experiencia",
                    title: "Experiência",
                    className: 'table-col-adm',
                    render: function(data) {
                        return data ? data : '-';
                    }
                },
                {
                    data: "de_nivel_experiencia",
                    title: "Nível",
                    className: 'table-col-adm',
                    render: function(data) {
                        return data ? data : '-';
                    }
                },
                {
                    data: "moedas_nivel",
                    title: "Moedas Nível",
                    className: 'table-col-adm',
                    render: function(data) {
                        return data ? data : '-';
                    }
                },
                {
                    data: "elogios",
                    title: "Elogios",
                    className: 'table-col-adm',
                    render: function(data) {
                        return data ? data : '-';
                    }
                },
                {
                    data: "hora_extra",
                    title: "Horas Extras",
                    className: 'table-col-adm',
                    render: function(data) {
                        return data ? data : '-';
                    }
                },
                {
                    data: "tma",
                    title: "TMA",
                    className: 'table-col-adm',
                    render: function(data) {
                        return data ? data : '-';
                    }
                },
                {
                    data: "outras_bonificacoes",
                    title: "Outras Bonificações",
                    className: 'table-col-adm',
                    render: function(data) {
                        return data ? data : '-';
                    }
                },
                {
                    data: "compras",
                    title: "Compras",
                    className: 'table-col-adm',
                    render: function(data) {
                        return data ? data : '-';
                    }
                },
                {
                    data: "glosa_de_qualidade",
                    title: "Glosa Qual.",
                    className: 'table-col-adm',
                    render: function(data) {
                        return data ? data : '-';
                    }
                },
                {
                    data: "falta_postural",
                    title: "F. Postural",
                    className: 'table-col-adm',
                    render: function(data) {
                        return data ? data : '-';
                    }
                },
                {
                    data: "falta_justificada",
                    title: "F. Just.",
                    className: 'table-col-adm',
                    render: function(data) {
                        return data ? data : '-';
                    }
                },
                {
                    data: "falta_injustificada",
                    title: "F. Injust.",
                    className: 'table-col-adm',
                    render: function(data) {
                        return data ? data : '-';
                    }
                },
                {
                    data: "outras_deducoes",
                    title: "Outras Deduções",
                    className: 'table-col-adm',
                    render: function(data) {
                        return data ? data : '-';
                    }
                }
            ],
            columnDefs: [{
                targets: [3, 4, 5, 9, 10, 15],
                visible: false
            }],
            lengthMenu: [
                [50, 100, 200, 400, -1],
                [50, 100, 200, 400, "TODOS"]
            ],
            paging: true,
            ordering: true,
            order: [
                [2, "desc"]
            ],
            searching: true,
            info: true,
            lengthChange: true,
            processing: true
        });

        $('#loading-overlay').show();

        $.ajax({
            url: "{{ route('BuscarResumoGeralPontos') }}",
            method: 'GET',
            data: {
                _token: "{{ csrf_token() }}"
            },
            success: function(response) {

                console.log(response);

                // Limpa os dados existentes na tabela
                tabelaADM.clear().draw();

                // Adiciona os novos dados à tabela
                tabelaADM.rows.add(response).draw();

                $('#loading-overlay').hide();

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


                $('#loading-overlay').hide();

            }
        });
    })
</script>
