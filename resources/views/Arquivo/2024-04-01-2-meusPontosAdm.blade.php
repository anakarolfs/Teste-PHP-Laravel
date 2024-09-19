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

    /* #tabela-pontos tr {
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: space-between;
    } */

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
        justify-content: center;
    }

    #tabela-pontos_length>label {
        color: white;
        margin: 0px 3px;
    }

    #tabela-pontos_length>select[name='tabela-pontos_length'] {
        margin: 0px 2px;
        padding: 0px 1px;
        height: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(to right, rgb(220, 220, 220) 0%, rgb(255, 255, 255) 100%);
        color: rgb(15, 47, 116);
        border: none;
        border-radius: 3px;
    }

    #tabela-pontos_filter {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    #tabela-pontos_filter>label {
        color: white;
        margin: 0px 3px;
    }

    #tabela-pontos_filter>input[type="search"] {
        margin: 0px 2px;
        padding: 0px 1px;
        height: 20px;
        /* display: flex;
        align-items: center;
        justify-content: center; */
        background: linear-gradient(to right, rgb(220, 220, 220) 0%, rgb(255, 255, 255) 100%);
        color: rgb(15, 47, 116);
        border: none;
        border-radius: 3px;
        box-shadow: rgba(0, 0, 0, 0.25) 0px 54px 55px, rgba(0, 0, 0, 0.12) 0px -12px 30px, rgba(0, 0, 0, 0.12) 0px 4px 6px, rgba(0, 0, 0, 0.17) 0px 12px 13px, rgba(0, 0, 0, 0.09) 0px -3px 5px;
    }

    #opcoes-tabela-abaixo {
        width: 100%;
        display: flex;
        align-items: baseline;
        justify-content: space-between;
    }

    #tabela-pontos_info {
        font-size: 15px;
    }

    #tabela-pontos_paginate {
        display: flex;
        margin: 0px 13px 15px 15px;
    }

    .paginate_button {
        margin: 0px 1px;
        padding: 0px 10px;
        height: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(to right, rgb(220, 220, 220) 0%, rgb(255, 255, 255) 100%);
        color: rgb(15, 47, 116);
        border: none;
        border-radius: 3px;
    }

    .paginate_button:disabled {
        background: linear-gradient(to right, rgb(120, 120, 120) 0%, rgb(155, 155, 155) 100%);
    }

    .paginate_button:hover {
        background: linear-gradient(to right, rgb(220, 220, 220) 0%, rgb(255, 255, 255) 100%);
        /* transform: scale(1.1); */
        text-decoration: none;
        cursor: pointer;
        color: rgb(15, 47, 116);
        box-shadow: rgba(0, 0, 0, 0.25) 0px 54px 55px, rgba(0, 0, 0, 0.12) 0px -12px 30px, rgba(0, 0, 0, 0.12) 0px 4px 6px, rgba(0, 0, 0, 0.17) 0px 12px 13px, rgba(0, 0, 0, 0.09) 0px -3px 5px;
    }
</style>

<div id="meus-pontos-adm" class="container">
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
    $(document).ready(function() {

        $.ajax({
            url: "{{ route('BuscarResumoGeralPontos') }}",
            method: 'GET',
            data: {
                _token: "{{ csrf_token() }}"
            },
            success: function(response) {

                console.log(response);

                montaTabelaRelatorio(response);

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
    })

    function montaTabelaRelatorio(response) {

        var tabelaADM = $('#tabela-pontos').DataTable({
            data: response,
            dom: 'Brlftip',
            buttons: [
                // {
                //     extend: 'colvis',
                //     className: 'myColvis',
                //     text: 'Colunas   ',
                // },
                {
                    extend: 'excel', // Excel export button
                    text: 'Exportar para Excel' // Button text
                }
            ],
            pagingType: 'full_numbers',
            language: {
                paginate: {
                    first: 'Primeira',
                    previous: 'Anterior',
                    next: 'Próxima',
                    last: 'Ultima'
                },
                info: 'Mostrando _START_ a _END_ de _TOTAL_ registro(s)'
            },
            columns: [{
                    data: "nome",
                    title: "Nome",
                    className: 'table-col-adm'
                },
                {
                    data: "mat_usuario",
                    title: "Matrícula",
                    className: 'table-col-adm'
                },
                {
                    data: "total_moedas",
                    title: "Total Moedas",
                    className: 'table-col-adm'
                },
                {
                    data: "nivel_experiencia",
                    title: "Experiência",
                    className: 'table-col-adm'
                },
                {
                    data: "de_nivel_experiencia",
                    title: "Nível",
                    className: 'table-col-adm'
                },
                {
                    data: "moedas_nivel",
                    title: "Moedas Nível",
                    className: 'table-col-adm'
                },
                {
                    data: "elogios",
                    title: "Elogios",
                    className: 'table-col-adm'
                },
                {
                    data: "hora_extra",
                    title: "Horas Extras",
                    className: 'table-col-adm'
                },
                {
                    data: "tma",
                    title: "TMA",
                    className: 'table-col-adm'
                },
                {
                    data: "outras_bonificacoes",
                    title: "Outras Bonificações",
                    className: 'table-col-adm'
                },
                {
                    data: "compras",
                    title: "Compras",
                    className: 'table-col-adm'
                },
                {
                    data: "glosa_de_qualidade",
                    title: "Glosa Qual.",
                    className: 'table-col-adm'
                },
                {
                    data: "falta_postural",
                    title: "F. Postural",
                    className: 'table-col-adm'
                },
                {
                    data: "falta_justificada",
                    title: "F. Just.",
                    className: 'table-col-adm'
                },
                {
                    data: "falta_injustificada",
                    title: "F. Injust.",
                    className: 'table-col-adm'
                },
                {
                    data: "outras_deducoes",
                    title: "Outras Deduções",
                    className: 'table-col-adm'
                }
            ],
            columnDefs: [{
                targets: [3, 4, 5, 9, 10, 15],
                visible: false
            }],
            paging: false,
            ordering: false,
            searching: false,
            info: false,
            lengthChange: false,

        });

        // var lengthMenuADM = $('#tabela-pontos_length');
        // var labelLengthADM = $('#tabela-pontos_length > label');
        // var selectLengthADM = $('select[name="tabela-pontos_length"]');

        // var searchFilterADM = $('#tabela-pontos_filter');
        // var labelSearchADM = $('#tabela-pontos_filter > label');
        // var inputSearchADM = $('#tabela-pontos_filter > label > input[type="search"]');

        // var infoADM = $('#tabela-pontos_info');

        // var paginateADM = $('#tabela-pontos_paginate');
        // // var  = $('#tabela-pontos_');

        // labelLengthADM.text('Mostrando: ');
        // lengthMenuADM.append(labelLengthADM);
        // lengthMenuADM.append(selectLengthADM);

        // labelSearchADM.text('Buscar: ');
        // searchFilterADM.append(labelSearchADM);
        // searchFilterADM.append(inputSearchADM);

        // $('#opcoes-tabela-acima').append(lengthMenuADM);
        // $('#opcoes-tabela-acima').append(searchFilterADM);
        // $('#opcoes-tabela-abaixo').append(infoADM);
        // $('#opcoes-tabela-abaixo').append(paginateADM);
    }
</script>
