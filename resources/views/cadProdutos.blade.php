
    {{--
<!DOCTYPE html>
<html>

    <style>



    </style>

    <head>

        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
	      <meta http-equiv="refresh" content="1800">
        <base target="_top"/>

        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Cadastrar Produtos</title>


      <meta name="description" content="Admin Dashboard Template" />
      <meta name="keywords" content="admin,dashboard" />
      <meta name="author" content="Steelcoders" />

      <script src="{{ asset('assets/plugins/jquery/jquery-2.1.3.min.js') }}"></script>
      <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>

      <link href="{{ asset('assets/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
      <link href="{{ asset('assets/plugins/datatables/buttons/css/buttons.bootstrap.css') }}" rel="stylesheet" type="text/css" />
      <link href="{{ asset('assets/plugins/datatables/buttons/css/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
      <script src="{{ asset('assets/plugins/bootstrap-notify/bootstrap-notify.js') }}"></script>

      <!--<script src="{{ asset('assets/plugins/datatables/buttons/js/buttons.bootstrap4.js') }}"></script>
      <script src="/assets/plugins/jquery/jquery-2.1.3.min.js" > </script>
      <script src="assets/plugins/bootstrap/js/bootstrap.min.js" > </script> -->


      <script src="{{ asset('assets/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
      <script src="{{ asset('assets/plugins/pace-master/pace.min.js') }}"></script>
      <script src="{{ asset('assets/plugins/jquery-blockui/jquery.blockui.js') }}"></script>
      <script src="{{ asset('assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>

      <script>var varToken = "{{ csrf_token() }}";</script>

    </head> 

    <noscript>
        erro!
    </noscript>

    <body>
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#cadProdruto">
            Cadastrar Produto
        </button>
--}}
        <!-- Modal CADASTRAR PRODUTO-->
        <div class="modal fade" id="cadProdruto" tabindex="-1" role="dialog" aria-labelledby="cadProdrutoLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h5 class="modal-title" id="cadProdrutoLabel">Novo Produto</h5>
                       
                    </div>
                    <div class="modal-body">
                        <form action="javascript:void(0);" id="formProdCad" class="form" method="POST"
                            enctype='multipart/form-data'>
                            <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}" />

                            <div class="row" style="padding-top:10px">
                                <div class="col-sm-6">
                                    <label for="nomeProd" class="col-form-label">Nome do Produto </label>
                                    <input required name="nomeProd" size="20" maxlength="20" class="form-control"
                                        id="nomeProd" placeholder="Digite aqui.">
                                </div>
                                <div class="col-sm-6">
                                    <label for="valorProd">Valor </label>
                                    <input  type="number" id="valorProd" name="valorProd" min="0"
                                        size="50" maxlength="50" class="form-control" placeholder="Digite aqui." />
                                </div>
                                <br />
                                <div class="col-sm-12">
                                    <label for="deProd" class="col-form-label">Descrição Produto </label>
                                    <input required name="deProd" size="50" maxlength="50" class="form-control"
                                        id="deProd" placeholder="Digite aqui.">
                                </div>
                            </div>

                            <div class="row" style="padding-top:10px">
                            <!--
                                <div class="col-sm-6">
                                    <label for="quantEstoqProd">Estoque </label>
                                    <input  type="number" id="quantEstoqProd" name="quantEstoqProd" min="0"
                                        max="100" size="50" maxlength="50" class="form-control"
                                        placeholder="Digite aqui." />
                                </div>
                            -->
                                
                            </div>

                            <div class="row" style="padding-top:10px">
                                <div class="col-sm-12">
                                    <label for="anexoPDF"><strong> Insira a Imagem: </strong></label>
                                    <input required type="file" name="anexoPDF" accept="image/png, image/jpeg">
                                </div>
                            </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn" data-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn modalSalvar">Salvar</button>
                        <!-- <button type="submit" class="btn btn-info" onClick="SalvarProd()">Salvar click</button> -->
                    </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal EDITAR PRODUTO-->
        <div class="modal fade" id="editProdruto" tabindex="-1" role="dialog" aria-labelledby="editProdrutoLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h5 class="modal-title" id="editProdrutoLabel">Editar Produto</h5>
                        
                    </div>
                    <div class="modal-body">
                        <form action="javascript:void(0);" id="formProdEdit" class="form" method="POST"
                            enctype='multipart/form-data'>
                            <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}" />
                            <input type="hidden" id="idProdEdit" name="idProdEdit"  />

                            <div class="row" style="padding-top:10px">
                                <div class="col-sm-6">
                                    <label for="nomeProdEdit" class="col-form-label">Nome do Produto </label>
                                    <input required name="nomeProdEdit"  id="nomeProdEdit" size="20" maxlength="20" class="form-control"
                                        id="nomeProd" placeholder="Digite aqui.">
                                </div>
                                <div class="col-sm-6">
                                    <label for="valorProdEdit">Valor </label>
                                    <input  type="number" id="valorProdEdit" name="valorProdEdit" min="0"
                                        size="50" maxlength="50" class="form-control" placeholder="Digite aqui." />
                                </div>
                                <br />
                                <div class="col-sm-12">
                                    <label for="deProdEdit" class="col-form-label">Descrição Produto </label>
                                    <input required name="deProdEdit" size="50" maxlength="50" class="form-control"
                                        id="deProdEdit" placeholder="Digite aqui.">
                                </div>
                            </div>
                            <!--
                            <div class="row" style="padding-top:10px">
                                <div class="col-sm-6">
                                    <label for="quantEstoqProd">Estoque </label>
                                    <input  type="number" id="quantEstoqProd" name="quantEstoqProd" min="0"
                                        max="100" size="50" maxlength="50" class="form-control"
                                        placeholder="Digite aqui." />
                                </div>
                            </div> -->
                            <!--
                            <div class="row" style="padding-top:10px">
                                <div class="col-sm-12">
                                    <label for="EditanexoPDF"><strong> Insira a Imagem: </strong></label>
                                    <input required type="file" name="EditanexoPDF" accept="image/png, image/jpeg">
                                </div>
                            </div> -->


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn" data-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn modalSalvar">Editar</button>
                        <!-- <button type="submit" class="btn btn-info" onClick="SalvarProd()">Salvar click</button> -->
                    </div>
                    </form>
                </div>
            </div>
        </div>
{{-- 
    </body>
--}}
    <script>
        $(document).ready(function() {
            limparModal();
        });

        /*
        $('#myModal').on('shown.bs.modal', function () {
          $('#myInput').trigger('focus')
        })
        */

        $(document).on("submit", "#formProdCad", function(event) {
            //  previne que o formulario seja redirecionado para a pagina de action
            event.preventDefault();

            $.ajax({
                //data: dataForm,
                data: new FormData(
                this), //$(this).serialize quer dizer que estou usando o formulario para serializar os campos em parametros do ajax
                cache: false,
                contentType: false,
                processData: false,
                url: 'SalvarProduto',
                method: 'post',
                //dataType: "json",
                //dataSrc: "", //utiliza o dataSrc para indicar que seja esperado um array e não um objeto
                success: function(result) {
                    //alert(result);
                    console.log(result)
                    alert('Salvo com sucesso!\n');
                    limparModal();
                    $('#cadProdruto').modal('hide');
                    //dataTable.ajax.reload();

                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    console.log(XMLHttpRequest);
                    console.log(textStatus);
                    console.log(errorThrown);
                    alert('Favor verificar as informações e Tentar novamente');
                }
            });

        });

        function abirModalEditarProd(idProd) {
        //alert('modal' + idProd);

        //realiza busca no servidor usando a rota /BuscarProdutoEdit
        $.ajax({
            data: {
                '_token': "{{ csrf_token() }}",
                idProd: idProd,
            },
            url: 'BuscarProdutoEdit',
            method: 'post',
            dataType: "json",
            success: function(result) {

                console.log(result.data[0])
                $('#editProdruto').modal('show');

                $('#idProdEdit').val(result.data[0].id_produto);
                $('#nomeProdEdit').val(result.data[0].no_produto);
                $('#valorProdEdit').val(result.data[0].vr_produto);
                $('#deProdEdit').val(result.data[0].de_produto);
                //$('#cadProdruto'). modal('hide');
            
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                alert('Favor verificar as informações e Tentar novamente');
            }
        });

        }

        $(document).on("submit", "#formProdEdit", function(event) {
            //  previne que o formulario seja redirecionado para a pagina de action
            event.preventDefault();

            $.ajax({
                //data: dataForm,
                data: new FormData(
                this), //$(this).serialize quer dizer que estou usando o formulario para serializar os campos em parametros do ajax
                cache: false,
                contentType: false,
                processData: false,
                url: 'EditarProduto',
                method: 'post',
                //dataType: "json",
                //dataSrc: "", //utiliza o dataSrc para indicar que seja esperado um array e não um objeto
                success: function(result) {
                    //alert(result);
                    console.log(result)
                    alert('Salvo com sucesso!\n');
                    $('#editProdruto').modal('hide');
                    //dataTable.ajax.reload();
                    document.location.reload();

                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    console.log(XMLHttpRequest);
                    console.log(textStatus);
                    console.log(errorThrown);
                    alert('Favor verificar as informações e Tentar novamente');
                }
            });

        });
        /*
        function SalvarProd() {
            //realiza busca no servidor usando a rota /SalvarProduto
            $.ajax({
                data: {
                    '_token': "{{ csrf_token() }}",
                    nomeProd: $('#nomeProd').val(),
                    deProd: $('#deProd').val(),
                    quantEstoqProd: $('#quantEstoqProd').val(),
                    valorProd: $('#valorProd').val(),
                    anexoPDF: $('#anexoPDF').val(),
                },
                url: '../public/SalvarProduto',
                method: 'post',
                dataType: "json",
                success: function(result) {
                    //alert(result);
                    console.log(result)
                    alert('Salvo com sucesso!\n');
                    limparModal();
                    $('#cadProdruto').modal('hide');
                    //dataTable.ajax.reload();

                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    console.log(XMLHttpRequest);
                    console.log(textStatus);
                    console.log(errorThrown);
                    alert('Favor verificar as informações e Tentar novamente');
                }
            });
        }
        */
        function limparModal() {
            document.getElementById('nomeProd').value = '';
            document.getElementById('deProd').value = '';
            //document.getElementById('quantEstoqProd').value = 0;
            document.getElementById('valorProd').value = '';
            //$("#anexoPDF").val("");
            const formulario = document.querySelector('#formProdCad');
            formulario.reset();
        }
    </script>

    {{-- </html> --}}


