<style>
    #meus-vencedores-adm {
        width: 96vw;
        display: flex;
        flex-direction: column;
        justify-content: center;
        background-color: rgba(15, 47, 116, 1);
        border-radius: 5px;
        box-shadow: rgba(0, 0, 0, 0.25) 0px 54px 55px, rgba(0, 0, 0, 0.12) 0px -12px 30px, rgba(0, 0, 0, 0.12) 0px 4px 6px, rgba(0, 0, 0, 0.17) 0px 12px 13px, rgba(0, 0, 0, 0.09) 0px -3px 5px;
        font-size: 10px;
    }

    #tabela-vencedores {
        margin-bottom: 15px;
        padding: 3px;
        width: 100%;
        height: auto;
        border-radius: 5px;
        background-color: rgba(0, 30, 95, 1);
        color: white;
        overflow-x: auto;
    }

    #tabela-vencedores .table-col-vencedores {
        margin: 0px 5px;
        font-size: 10px;
        font-weight: 100;
        text-align: left;
    }

    #tabela-vencedores .num-vencedor {
        text-align: center;
    }

    #tabela-vencedores th.sorting {
        border-bottom: 1px solid white;
        font-size: 12px;
    }

    /* #tabela-vencedores tr {
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

    #opcoes-tabela-vencedores-acima {
        display: flex;
        flex-grow: 1;
        align-items: baseline;
        justify-content: flex-end;
    }

    #opcoes-tabela-vencedores-acima>div {
        margin: 10px;
    }

    #tabela-vencedores_length {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    #tabela-vencedores_length>label {
        color: white;
        margin: 0px 3px;
    }

    #tabela-vencedores_length>select[name='tabela-vencedores_length'] {
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

    #tabela-vencedores_filter {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    #tabela-vencedores_filter>label {
        color: white;
        margin: 0px 3px;
    }

    #tabela-vencedores_filter>input[type="search"] {
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

    #opcoes-tabela-vencedores-abaixo {
        width: 100%;
        display: flex;
        align-items: baseline;
        justify-content: space-between;
    }

    #tabela-vencedores_info {
        font-size: 15px;
    }

    #tabela-vencedores_paginate {
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

<div id="meus-vencedores-adm" class="container">
    <div class="titulo-filtro-container filtros-datatables">
        <div id="titulo"> {{-- class="titulo" --}}
            <h1>Vencedores</h1>
        </div>
        <div id="opcoes-tabela-vencedores-acima"></div>
    </div>
    <table id="tabela-vencedores" style="width: 100%;">
        <thead>
            <tr>
            </tr>
        </thead>
        <tbody>

        </tbody>
    </table>
    <div id="opcoes-tabela-vencedores-abaixo"></div>
</div>

{{-- script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">


<script>
    $(document).ready(function() {

        $.ajax({
            url: "{{ route('BuscarVencedoresLeilao') }}",
            method: 'GET',
            data: {
                _token: "{{ csrf_token() }}"
            },
            success: function(response) {

                console.log(response);

                montaTabelaRelatorioVencedores(response);

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

    function montaTabelaRelatorioVencedores(response) {

        var tabelaVencedores = $('#tabela-vencedores').DataTable({
            data: response,
            dom: 'Brlftip',
            buttons: [
                // {
                //     extend: 'colvis',
                //     className: 'myColvis',
                //     text: 'Colunas   ',
                // },
                {
                    extend: 'excel',
                    text: 'Exportar para Excel'
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
                    data: "numero",
                    title: "Nº",
                    className: 'table-col-vencedores num-vencedor'
                },
                {
                    data: "vencedor",
                    title: "Nome",
                    className: 'table-col-vencedores'
                },
                {
                    data: "matricula",
                    title: "Matrícula",
                    className: 'table-col-vencedores'
                },
                {
                    data: "produto",
                    title: "Produto",
                    className: 'table-col-vencedores'
                },
                {
                    data: "complemento",
                    title: "Complemento",
                    className: 'table-col-vencedores'
                },
                {
                    data: "id_lances_leilao",
                    title: "ID Lance",
                    className: 'table-col-vencedores'
                },
                {
                    data: "id_produto",
                    title: "ID Produto",
                    className: 'table-col-vencedores'
                },
                {
                    data: "vr_lance",
                    title: "Lance",
                    className: 'table-col-vencedores'
                },
                {
                    data: "st_lance",
                    title: "Status do Lance",
                    className: 'table-col-vencedores'
                },
                {
                    data: "dt_lance",
                    title: "Data do Lance",
                    className: 'table-col-vencedores'
                },
                {
                    data: "fim_leilao",
                    title: "Fim do Leilão",
                    className: 'table-col-vencedores'
                }
            ],
            columnDefs: [{
                targets: [5, 6, 8],
                visible: false
            }],
            paging: false,
            ordering: false,
            searching: false,
            info: false,
            lengthChange: false
        });

        // var lengthMenuVencedores = $('#tabela-vencedores_length');
        // var labelLengthVencedores = $('#tabela-vencedores_length > label');
        // var selectLengthVencedores = $('select[name="tabela-vencedores_length"]');

        // var searchFilterVencedores = $('#tabela-vencedores_filter');
        // var labelSearchVencedores = $('#tabela-vencedores_filter > label');
        // var inputSearchVencedores = $('#tabela-vencedores_filter > label > input[type="search"]');

        // var infoVencedores = $('#tabela-vencedores_info');

        // var paginateVencedores = $('#tabela-vencedores_paginate');

        // labelLengthVencedores.text('Mostrando: ');
        // lengthMenuVencedores.append(labelLengthVencedores);
        // lengthMenuVencedores.append(selectLengthVencedores);

        // labelSearchVencedores.text('Buscar: ');
        // searchFilterVencedores.append(labelSearchVencedores);
        // searchFilterVencedores.append(inputSearchVencedores);

        // $('#opcoes-tabela-vencedores-acima').append(lengthMenuVencedores);
        // $('#opcoes-tabela-vencedores-acima').append(searchFilterVencedores);
        // $('#opcoes-tabela-vencedores-abaixo').append(infoVencedores);
        // $('#opcoes-tabela-vencedores-abaixo').append(paginateVencedores);
    }
</script>
