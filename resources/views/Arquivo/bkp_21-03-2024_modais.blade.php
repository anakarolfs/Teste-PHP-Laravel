<style>

    .modal-header{
        background: linear-gradient(to right, rgb(251, 74, 110) 0%, rgb(252, 86, 72) 100%);
        color: white;
        font-weight: bold;
    }

    .modalSalvar{
        background-color:#fc416f;
        border-color: #fc416f;
        color: white;
    }

    
    .modalSalvar:hover{
        background-color:rgb(252, 86, 72);
        border-color: rgb(252, 86, 72);
        color: white;
    }

    .swal2-styled.swal2-confirm {
        background-color:#fc416f;
    }

</style>

<!-- Modal LANCES -->
<div class="modal fade" id="modalLances" tabindex="-1" role="dialog" aria-labelledby="modalLancesLabel"
aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h5 class="modal-title" id="modalLancesLabel"><h4 id="divProduto"> </h4></h5>
              
            </div>
            <div class="modal-body">
                <form action="javascript:void(0);" id="formSalvarLance" class="form" method="POST"
                    enctype='multipart/form-data'>
                    <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}" />
                    <input type="hidden" id="modalIdLance" name="modalIdLance" />

                    <div class="row" style="padding-top:10px">
                        <div class="col-sm-6">
                            <h4 id="divUltLance"> Maior Lance: </h4>
                            <input type="hidden" id="InputUltLance" name="InputUltLance" />
                        </div>
                        <div class="col-sm-6">
                            <h4 id="divMeuUltLance"> Meu Ultimo Lance: </h4>
                        </div>
                        <div class="col-sm-12">
                            <label for="valorlanceProd">Valor </label>
                            <input required type="number" id="valorlanceProd" name="valorlanceProd"
                                min="0" max="{{$minhasMoedas}}" size="50" maxlength="50"
                                class="form-control" placeholder="Digite aqui." />
                        </div>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn" data-dismiss="modal">Fechar</button>
                <button type="submit" class="btn modalSalvar" onClick="salvarLance()">Salvar lance</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal INICIAR LEILÃO -->
<div class="modal fade" id="modalIniciarLeilao" tabindex="-1" role="dialog" aria-labelledby="modalIniciarLeilaoLabel"
aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalIniciarLeilaoLabel">Iniciar Leilão</h5>
            </div>

            <div class="modal-body">
                <form action="javascript:void(0);" id="formIniciarLeilao" class="form" method="POST"
                    enctype='multipart/form-data'>
                    <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}" />
                    <input type="hidden" id="idProd" name="idProd" />

                    <div class="row" style="padding-top:10px">
                        <div class=" col-md-6" >
                            <label for="dataFimLeilao">Data fim leilão:</label> 
                            <input type="text" class="form-control" id="dataFimLeilao" name="dataFimLeilao" readonly="" required value="<?=date('d/m/Y'); ?>">
                        </div>
                        <div class=" col-md-6" >
                            <label for="horaFimLeilao">Hora fim leilão:</label> 
                            <input type="time" class="form-control" id="horaFimLeilao" name="horaFimLeilao" required value="<?=date('23:59'); ?>"/>
                        </div>
                    </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn" data-dismiss="modal">Fechar</button>
                <button type="submit" class="btn modalSalvar">Iniciar</button>
            </div>
                </form>
        </div>
    </div>
</div>


<script src="{{ asset('assets/js/sweetalert2.min.js') }}"></script>
<link href="{{ asset('assets/jquery-ui-1.12.1.custom/jquery-ui.min.css') }}" rel="stylesheet" type="text/css"/>
<script src="{{ asset('assets/jquery-ui-1.12.1.custom/jquery-ui.min.js') }}"></script>
  
<script>	
var dataFimLeilao = '<?php echo date('d/m/Y'); ?>';

    $(document).ready(function() {

        $("#dataFimLeilao").datepicker({
            dateFormat: 'dd/mm/yy',
            dayNames: ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado'],
            dayNamesMin: ['D', 'S', 'T', 'Q', 'Q', 'S', 'S'],
            dayNames: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb'],
            monthNames: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
            nextText: 'Próximo',
            prevText: 'Anterior'
        });
         //$("#dataFimLeilao").datepicker('setDate', new Date());
    });

    var valorMaxProd = {{$minhasMoedas}};

    function limite(e){	
        try{var element = e.target		  }catch(er){};		
        try{var element = event.srcElement  }catch(er){};				
        try{var ev = e.which	   }catch(er){};		
        try{var ev = event.keyCode }catch(er){};		
        if((ev!=0) && (ev!=8) &&(ev!=13))			
        if  (! RegExp(/[0-9]/gi).test(String.fromCharCode(ev))) return false;						
        if(element.value + String.fromCharCode(ev) > valorMaxProd) return false;			}	
        window.onload = function(){		document.getElementById('valorlanceProd').onkeypress = limite	}
  
    function abirModalLance(idProd) {
        //alert('modal' + idProd);

        //realiza busca no servidor usando a rota /BuscarProduto
        $.ajax({
            data: {
                '_token': "{{ csrf_token() }}",
                idProd: idProd,
            },
            url: 'BuscarProduto',
            method: 'post',
            dataType: "json",
            success: function(result) {

                console.log(result.data[0].no_produto)
                $('#modalLances').modal('show');
                //$('#cadProdruto'). modal('hide');
                vr_lance = result.data[0].vr_lance
                vr_produto = result.data[0].vr_lance

                if (vr_lance == null) {
                    vr_lance = 0;
                    vr_produto = result.data[0].vr_produto
                }

                $('#modalIdLance').val(result.data[0].id_produto);

                $('#valorlanceProd').val(vr_produto);

                var div = document.getElementById("divProduto");
                div.innerHTML = "<h4>" + result.data[0].no_produto + "</h4>" + "\n";
                //div.innerText = "<h1>" + titulo +"</h1>"+ "\n" + subtitulo;

                var div = document.getElementById("divUltLance");
                div.innerHTML = "<h4> Maior Lance: " + vr_produto + "</h4>" + "\n";
                $('#InputUltLance').val(vr_produto);

                var div = document.getElementById("divMeuUltLance");
                div.innerHTML = "<h4> Meu Ultimo Lance: " + vr_lance + "</h4>" + "\n";

            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                alert('Favor verificar as informações e Tentar novamente');
            }
        });

    }

    function salvarLance() {
        
        idProd = $('#modalIdLance').val();
        valorLance = $('#valorlanceProd').val();
        UltLance = $('#InputUltLance').val();
        console.log(valorLance);

        if(valorLance <= UltLance){
            alert('Valor do Lance menor ou igual que o anterior.');
        }else{
            //alert(UltLance);
            if (valorLance != null && valorLance != '') {

                //realiza busca no servidor usando a rota /SalvarLance
                $.ajax({
                    data: {
                        '_token': "{{ csrf_token() }}",
                        idProd: idProd,
                        valorLance: valorLance,
                    },
                    url: 'SalvarLance',
                    method: 'post',
                    dataType: "json",
                    success: function(result) {

                        console.log(result)
                        $('#modalLances').modal('hide');
                        document.location.reload();

                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown) {
                        alert('Favor verificar as informações e Tentar novamente');
                    }
                });
            } 
        }
    }

    function AtivarProduto(idProd) {

        console.log('AtivarProduto');
        Swal. fire({ 
            title: 'Tem certeza que deseja Ativar este Produto?' , 
            icon: 'warning', 
            showConfirmButton: true,
            confirmButtonText: 'Sim', 
            showCancelButton: true,
            cancelButtonText: 'Não' })
                         .then((result) => {
                             if (result.isConfirmed) {
                                // window.location.href("{ { route('listar.parceiros') } }");
                                $.ajax({
                                    data: {
                                        '_token': "{{ csrf_token() }}",
                                        idProd: idProd,
                                    },
                                    url: 'AtivarProduto',
                                    method: 'post',
                                    dataType: "json",
                                    success: function(result) {

                                        console.log(result)
                                        alert('Ativado com sucesso!\n');
                                        document.location.reload();
 
                                    },
                                    error: function(XMLHttpRequest, textStatus, errorThrown) {
                                        alert('Favor verificar as informações e Tentar novamente');
                                    }
                                });
                             }
                         });
    }

    function DesativarProduto(idProd) {

        console.log('DesativarProduto');
        Swal. fire({ 
            title: 'Tem certeza que deseja Desativar este Produto?' , 
            icon: 'warning', 
            showConfirmButton: true,
            confirmButtonText: 'Sim', 
            showCancelButton: true,
            cancelButtonText: 'Não' })
                         .then((result) => {
                             if (result.isConfirmed) {
                                // window.location.href("{ { route('listar.parceiros') } }");
                                $.ajax({
                                    data: {
                                        '_token': "{{ csrf_token() }}",
                                        idProd: idProd,
                                    },
                                    url: 'DesativarProduto',
                                    method: 'post',
                                    dataType: "json",
                                    success: function(result) {

                                        console.log(result)
                                        alert('Desativado com sucesso!\n');
                                        document.location.reload();
 
                                    },
                                    error: function(XMLHttpRequest, textStatus, errorThrown) {
                                        alert('Favor verificar as informações e Tentar novamente');
                                    }
                                });
                             }
                         });
                         
    }

    function ExcluirProduto(idProd) {
        
        console.log('ExcluirProduto');
        Swal. fire({ 
            title: 'Tem certeza que deseja Excluir este Produto?' , 
            icon: 'warning', 
            showConfirmButton: true,
            confirmButtonText: 'Sim', 
            showCancelButton: true,
            cancelButtonText: 'Não' })
                         .then((result) => {
                             if (result.isConfirmed) {
                                // window.location.href("{ { route('listar.parceiros') } }");
                                $.ajax({
                                    data: {
                                        '_token': "{{ csrf_token() }}",
                                        idProd: idProd,
                                    },
                                    url: 'ExcluirProduto',
                                    method: 'post',
                                    dataType: "json",
                                    success: function(result) {

                                        console.log(result)
                                        alert('Excluido com sucesso!\n');
                                        document.location.reload();
 
                                    },
                                    error: function(XMLHttpRequest, textStatus, errorThrown) {
                                        alert('Favor verificar as informações e Tentar novamente');
                                    }
                                });
                             }
                         });
    }

    function IniciarLeilao(idProd) {

        $('#idProd').val(idProd);
        $('#modalIniciarLeilao').modal('show');
    }

    $(document).on("submit", "#formIniciarLeilao", function(event) {
            //  previne que o formulario seja redirecionado para a pagina de action
            event.preventDefault();
            console.log('IniciarLeilao');
            
            $.ajax({
                //data: dataForm,
                data: new FormData(
                this), //$(this).serialize quer dizer que estou usando o formulario para serializar os campos em parametros do ajax
                cache: false,
                contentType: false,
                processData: false,
                url: 'IniciarLeilao',
                method: 'post',
                //dataType: "json",
                //dataSrc: "", //utiliza o dataSrc para indicar que seja esperado um array e não um objeto
                success: function(result) {
                    //alert(result);
                    console.log(result)
                    alert('Salvo com sucesso!\n');

                    $('#modalIniciarLeilao').modal('hide');
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

    function CancelarLeilao(idProd) {
        
        console.log('CancelarLeilao');
        Swal. fire({ 
            title: 'Tem certeza que deseja Cancelar este Leilão?' , 
            icon: 'warning', 
            showConfirmButton: true,
            confirmButtonText: 'Sim', 
            showCancelButton: true,
            cancelButtonText: 'Não' })
                         .then((result) => {
                             if (result.isConfirmed) {
                                // window.location.href("{ { route('listar.parceiros') } }");
                                $.ajax({
                                    data: {
                                        '_token': "{{ csrf_token() }}",
                                        idProd: idProd,
                                    },
                                    url: 'CancelarLeilao',
                                    method: 'post',
                                    dataType: "json",
                                    success: function(result) {

                                        console.log(result)
                                        alert('Cancelado com sucesso!\n');
                                        document.location.reload();
 
                                    },
                                    error: function(XMLHttpRequest, textStatus, errorThrown) {
                                        alert('Favor verificar as informações e Tentar novamente');
                                    }
                                });
                             }
                         });
    }

</script>