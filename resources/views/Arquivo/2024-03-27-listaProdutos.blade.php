{{-- @if (cargo == 'Coord') --}}
@if (count($adm) == 1)
<div class="btn-menu" style="margin-left: -95%;">
    <span></span>
    <span></span>
    <span></span>
</div>
<nav class="menu">
    <ul>
    <li onClick='AbrirLoja()' >Abrir Loja</li>
    <!--
    <li onClick='CadastrarProduto()' >Cadastrar Produto</li>
    <li>Produtos
        <ul style="display:none">
            <li>1</li>
            <li>2</li>
            <li>3</li>
        </ul>
    </li>
    <li>Contato</li>
    -->
    </ul>
</nav>
@endif


<div style="display: block;">
@if (count($moedas) != 0)
    <input type="hidden"  value="{{ $minhasMoedas = $moedas[0]->total_moedas }}" />
@else
    <input type="hidden"  value="{{ $minhasMoedas }}" />
@endif

@if($statusLoja[0]->lj_aberta == 0)
    {{-- {{ $vrfStatusLoja = 'disabled' }} --}}
    <input type="hidden"  value="{{ $vrfStatusLoja = 'disabled' }}" />
@else
     {{-- {{ $vrfStatusLoja = '' }} --}}
    <input type="hidden"  value="{{ $vrfStatusLoja = '' }}" />
@endif
</div>

<div class="lista-produtos">

    @if (count($adm) == 1)
        <div class="produto adicionar" style="text-align: center;">
            <button type="button" class="btn btn-primary btn-adicionar" title="Cadastrar Produto" data-toggle="modal" data-target="#cadProdruto">
                <span style="font-size: 5rem;" class="glyphicon glyphicon-plus"></span>
            </button>
        </div>
        @include('cadProdutos')

    @endif

@foreach ($listProdutos as $produto)
    @if (count($adm) == 1) {{-- ADMINISTRADOR --}}
        <div class="produto">
            <div class="row">
                {{-- BOTÕES DE REMOVER APARENTES MEDIANTES A CARGO DE COORDENADOR --}}
                @if (count($adm) == 1 && $produto->ic_status != 2 && $produto->ic_status != 3)
                    <div class="col-sm-12 foto-div" style="margin-left: 47%; margin-top: -5%;">
                        <button class="btn btn-primary btn-editar btn-desCurtir" title="Editar" onClick='abirModalEditarProd("{{ $produto->id_produto }}")'><span class="glyphicon glyphicon-pencil"></span></button>
                        <button class="btn btn-primary btn-remover btn-desCurtir" title="Excluir" onClick='ExcluirProduto("{{ $produto->id_produto }}")'><span class="glyphicon glyphicon-trash"></span></button>

                        @if ($produto->st_produto == 0)
                            <button class="btn btn-primary btn-editar btn-desCurtir" title="Ativar" onClick='AtivarProduto("{{ $produto->id_produto }}")'><span class="glyphicon glyphicon-ok"></span></button>
                        @elseif ($produto->ic_status != 2 && $produto->vr_produto != null || $produto->vr_produto != '')
                            <button class="btn btn-primary btn-editar btn-desCurtir" title="Iniciar Leilão" onClick='IniciarLeilao("{{ $produto->id_produto }}")'><span class="glyphicon glyphicon-play"></span></button>
                        @else
                            <button class="btn btn-primary btn-remover btn-desCurtir" title="Desativar" onClick='DesativarProduto("{{ $produto->id_produto }}")'><span class="glyphicon glyphicon-remove"></span></button>
                        @endif
                    </div>
                @elseif (count($adm) == 1 && $produto->ic_status == 2 && $today < $produto->diafechamento)
                    <div class="col-sm-12 foto-div" style="margin-left: 80%; margin-top: -5%;">
                        <button class="btn btn-primary btn-editar btn-desCurtir" title="Cancelar Leilão" onClick='CancelarLeilao("{{ $produto->id_produto }}")'><span class="glyphicon glyphicon-stop"></span></button>
                    </div>
                {{--
                @elseif (count($adm) == 1 && $produto->ic_status == 4)
                    <div class="col-sm-12 foto-div" style="margin-left: 80%; margin-top: -5%;">
                        <button class="btn btn-primary btn-remover btn-desCurtir" title="Excluir" onClick='ExcluirProduto("{{ $produto->id_produto }}")'><span class="glyphicon glyphicon-trash"></span></button>
                    </div>
                --}}
                @elseif (count($adm) == 1 && $produto->ic_status == 3 || $today > $produto->diafechamento)
                    <div class="col-sm-12 foto-div" style="margin-left: 80%; margin-top: -5%;">
                        <button class="btn btn-primary btn-remover btn-desCurtir" title="Novo Produto" onClick='NovoProduto("{{ $produto->id_produto }}")'><span class="glyphicon glyphicon-repeat"></span></button>
                    </div>

                @else
                    <div class="col-sm-12 foto-div" style="margin-left: 80%; margin-top: -5%;">
                        @if ($produto->st_desejos == 1)
                            <button class="btn btn-danger btn-curtir" title="Remover da Lista de Desejos"
                                onClick='removerReacao("{{ $produto->id_produto }}")'>
                                <span class="glyphicon glyphicon-heart"></span></button>
                        @elseif (count($desejos) > 5)
                            <button class="btn btn-primary btn-bloqCurtir" title="Limite Lista de Desejos Atingido">
                                <span class="glyphicon glyphicon-heart"></span></button>
                        @else
                            <button class="btn btn-primary btn-desCurtir" title="Adicionar a Lista de Desejos"
                                onClick='salvarReacao("{{ $produto->id_produto }}")'>
                                <span class="glyphicon glyphicon-heart"></span></button>
                        @endif
                    </div>
                @endif

                <div class="col-sm-12 foto-div">
                    <img class="foto-produto" src="produtos/{{ $produto->img_produto }}" alt="">
                </div>
            </div>
            <div class="row" class="info-produto" style="text-align: center;">
                <div class="nome-produto col-sm-12">
                    <h4 style="margin-bottom:2px; font-family: 'Trebuchet MS'; font-weight: bold">
                        {{ $produto->no_produto }}</h4>
                </div>
                <div class="col-sm-12" style="height: 40px;">
                    <p> {{ $produto->de_produto }}</p>
                </div>
                <div class="preco-produto col-sm-12" style="text-align: center;">
                    <p style="font-weight: bold; color:#337ab7; font-size:15px; margin-bottom: -1px;"> Lance Atual </p>
                        @if ($produto->vr_lance == null)
                            <p style="font-weight: bold; color:#337ab7; font-size:18px; margin-bottom: -1px;"> <img class="foto-moeda" src="assets\images\PLANCOIN.png" alt=""> {{ $produto->vr_produto }}</p>
                        @else
                            <p style="font-weight: bold; color:#337ab7; font-size:18px; margin-bottom: -1px;"> <img class="foto-moeda" src="assets\images\PLANCOIN.png" alt=""> {{ $produto->vr_lance }}</p>
                        @endif
                </div>
                <div class="preco-produto col-sm-12" style="text-align: center;">
                    <p style="font-weight: bold; color:#337ab7; font-size:11px; "> ({{ $produto->total_lance}} Lances) </p>
            </div>

            </div>
            <div class="row" class="opcoes-produto">
                <div class="col-sm-12">
                    <!-- ===========================================================================
                        <button { {$vrfStatusLoja}} onClick='comprarProduto("{ { $produto->id_produto }}")' type="button"
                            class="btn btn-primary btn-comprar" style="width: 100%; border-color:#fc416f; background-color: #fc416f;">
                            Comprar
                        </button>
                        ================================================================================ -->
                    @if ($produto->st_produto == 0)
                        <button disabled type="button" class="btn btn-primary btn-comprar" style="width: 100%;">
                            Desativado
                        </button>
                    @elseif ($produto->ic_status == 4)
                        <button disabled type="button" class="btn btn-primary" style="width: 100%; border-color:#ff5c44; background-color: #ff5c44;">
                            Cancelado
                        </button>
                    @elseif ($produto->ic_status == 3)
                    @elseif($produto->vr_produto == null || $produto->vr_produto == '')
                        <button disabled type="button" class="btn btn-primary btn-comprar" style="width: 100%;">
                            Aguardando
                        </button>
                    @elseif($today > $produto->diafechamento && $produto->dh_fechamento != null)
                            <!--
                            <button disabled type="button" class="btn btn-primary" style="width: 100%; border-color:#ff5c44; background-color: #ff5c44;">
                                Finalizado
                            </button> -->
                    @elseif($minhasMoedas >= $produto->vr_produto && $minhasMoedas >= $produto->vr_lance && $produto->dh_abertura <= $dhHoje && $produto->dh_abertura != null && $produto->mat_lance == $_COOKIE['MATRICULA'] )
                        <button onClick='abirModalLance("{{ $produto->id_produto }}")' type="button"
                            class="btn btn-primary btn-comprar" style="width: 100%; border-color:green; background-color: green;">
                            Vencendo
                        </button>
                    @elseif($produto->dh_abertura <= $dhHoje && $produto->dh_abertura != null && $produto->mat_lance == $_COOKIE['MATRICULA'] )
                        <button type="button"
                            class="btn btn-primary btn-comprar" style="width: 100%; border-color:green; background-color: green;">
                            Vencendo
                        </button>
                    @elseif($minhasMoedas >= $produto->vr_produto && $minhasMoedas >= $produto->vr_lance && $produto->dh_abertura <= $dhHoje && $produto->dh_abertura != null && $produto->ic_status != 3 )
                        <button onClick='abirModalLance("{{ $produto->id_produto }}")' type="button"
                            class="btn btn-primary btn-comprar" style="width: 100%; border-color:#fc416f; background-color: #fc416f;">
                            Dar Lance
                        </button>
                    @else
                        <div class="progress" style="height: 10px;" title="Progresso Moedas">
                            <div class="progress-bar progress-bar-striped bg-success" role="progressbar"
                                style="height: 10px; width: {{ round(($minhasMoedas / $produto->vr_produto) * 100) }}%"
                                aria-valuenow="25" aria-valuemin="0" aria-valuemax="{{ $produto->vr_produto }}">
                            </div>
                        </div>
                        <div style="margin-top: -16px; text-align: center; font-size: 12px;">
                            <img style="width: 12%; height: 22px;" src="assets\images\PLANCOIN.png" alt=""> {{ $minhasMoedas .' / '. $produto->vr_produto }}
                        </div>
                    @endif

                    <div class="col-sm-12" style="text-align: center; padding: 0;">
                        @if(($today > $produto->diafechamento && $produto->dh_fechamento != null) || $produto->ic_status == 3 )
                            <p style="font-weight: bold; color:gray; font-size:13px; margin-top: 5px"> Ganhador - {{$produto->nome}} </p>
                        @elseif($produto->dh_fechamento != null && $produto->ic_status != 4)
                            @if($dtHoje == $produto->dt_fechamento)
                                <p style="font-weight: bold; color:red; font-size:13px; margin-top: 5px"> Termina {{$produto->dt_fechamento}} às {{$produto->hh_fechamento}}</p>
                            @elseif($today < $produto->diafechamento)
                                <p style="font-weight: bold; color:green; font-size:13px; margin-top: 5px"> Termina {{$produto->dt_fechamento}} às {{$produto->hh_fechamento}}</p>
                            @else
                                <p style="font-weight: bold; color:gray; font-size:13px; margin-top: 5px"> </p>
                            @endif
                        @endif
                    </div>

                </div>
            </div>
        </div>
    @else {{-- OPERADOR --}}
        @if ($produto->st_produto == 1)
            <div class="produto">
                <div class="row">
                    <div class="col-sm-12 foto-div" style="margin-left: 80%; margin-top: -5%;">
                        @if ($produto->st_desejos == 1)
                            <button class="btn btn-danger btn-curtir" title="Remover da Lista de Desejos"
                                onClick='removerReacao("{{ $produto->id_produto }}")'>
                                <span class="glyphicon glyphicon-heart"></span></button>
                        @elseif (count($desejos) > 5)
                            <button class="btn btn-primary btn-bloqCurtir" title="Limite Lista de Desejos Atingido">
                                <span class="glyphicon glyphicon-heart"></span></button>
                        @else
                            <button class="btn btn-primary btn-desCurtir" title="Adicionar a Lista de Desejos"
                                onClick='salvarReacao("{{ $produto->id_produto }}")'>
                                <span class="glyphicon glyphicon-heart"></span></button>
                        @endif
                    </div>

                    <div class="col-sm-12 foto-div">
                        <img class="foto-produto" src="produtos/{{ $produto->img_produto }}" alt="">
                    </div>
                </div>
                <div class="row" class="info-produto" style="text-align: center;">
                    <div class="nome-produto col-sm-12">
                        <h4 style="margin-bottom:2px; font-family: 'Trebuchet MS'; font-weight: bold">
                            {{ $produto->no_produto }}</h4>
                    </div>
                    <div class="col-sm-12" style="height: 40px;">
                        <p> {{ $produto->de_produto }}</p>
                    </div>
                    <div class="preco-produto col-sm-12" style="text-align: center;">
                        <p style="font-weight: bold; color:#337ab7; font-size:15px; margin-bottom: -1px;"> Lance Atual </p>
                            @if ($produto->vr_lance == null)
                                <p style="font-weight: bold; color:#337ab7; font-size:18px; margin-bottom: -1px;"> <img class="foto-moeda" src="assets\images\PLANCOIN.png" alt=""> {{ $produto->vr_produto }}</p>
                            @else
                                <p style="font-weight: bold; color:#337ab7; font-size:18px; margin-bottom: -1px;"> <img class="foto-moeda" src="assets\images\PLANCOIN.png" alt=""> {{ $produto->vr_lance }}</p>
                            @endif
                    </div>
                    <div class="preco-produto col-sm-12" style="text-align: center;">
                        <p style="font-weight: bold; color:#337ab7; font-size:11px; "> ({{ $produto->total_lance}} Lances) </p>
                    </div>

                </div>
                <div class="row" class="opcoes-produto">
                    <div class="col-sm-12">
                        @if ($produto->ic_status == 4)
                            <button disabled type="button" class="btn btn-primary" style="width: 100%; border-color:#ff5c44; background-color: #ff5c44;">
                                Cancelado
                            </button>
                        @elseif ($produto->ic_status == 3)
                        @elseif($produto->vr_produto == null || $produto->vr_produto == '')
                            <button disabled type="button" class="btn btn-primary btn-comprar" style="width: 100%;">
                                Aguardando
                            </button>
                        @elseif($today > $produto->diafechamento && $produto->dh_fechamento != null)
                            <!--
                            <button disabled type="button" class="btn btn-primary" style="width: 100%; border-color:#ff5c44; background-color: #ff5c44;">
                                Finalizado
                            </button> -->
                        @elseif($minhasMoedas >= $produto->vr_produto && $minhasMoedas >= $produto->vr_lance && $produto->dh_abertura <= $dhHoje && $produto->dh_abertura != null && $produto->mat_lance == $_COOKIE['MATRICULA'] )
                            <button onClick='abirModalLance("{{ $produto->id_produto }}")' type="button"
                                class="btn btn-primary btn-comprar" style="width: 100%; border-color:green; background-color: green;">
                                Vencendo
                            </button>
                        @elseif($produto->dh_abertura <= $dhHoje && $produto->dh_abertura != null && $produto->mat_lance == $_COOKIE['MATRICULA'] )
                            <button type="button"
                                class="btn btn-primary btn-comprar" style="width: 100%; border-color:green; background-color: green;">
                                Vencendo
                            </button>
                        @elseif($minhasMoedas >= $produto->vr_produto && $minhasMoedas >= $produto->vr_lance && $produto->dh_abertura <= $dhHoje && $produto->dh_abertura != null && $produto->ic_status != 3 )
                            <button onClick='abirModalLance("{{ $produto->id_produto }}")' type="button"
                                class="btn btn-primary btn-comprar" style="width: 100%; border-color:#fc416f; background-color: #fc416f;">
                                Dar Lance
                            </button>
                        @else
                            <div class="progress" style="height: 10px;" title="Progresso Moedas">
                                <div class="progress-bar progress-bar-striped bg-success" role="progressbar"
                                    style="height: 10px; width: {{ round(($minhasMoedas / $produto->vr_produto) * 100) }}%"
                                    aria-valuenow="25" aria-valuemin="0" aria-valuemax="{{ $produto->vr_produto }}">
                                </div>
                            </div>
                            <div style="margin-top: -16px; text-align: center; font-size: 12px;">
                                <img style="width: 12%; height: 22px;" src="assets\images\PLANCOIN.png" alt=""> {{ $minhasMoedas .' / '. $produto->vr_produto }}
                            </div>
                        @endif

                        <div class="col-sm-12" style="text-align: center; padding: 0;">
                            @if(($today > $produto->diafechamento && $produto->dh_fechamento != null) || $produto->ic_status == 3 )
                                <p style="font-weight: bold; color:gray; font-size:13px; margin-top: 5px"> Ganhador - {{$produto->nome}} </p>
                            @elseif($produto->dh_fechamento != null && $produto->ic_status != 4)
                                @if($dtHoje == $produto->dt_fechamento)
                                    <p style="font-weight: bold; color:red; font-size:13px; margin-top: 5px"> Termina {{$produto->dt_fechamento}} às {{$produto->hh_fechamento}}</p>
                                @elseif($today < $produto->diafechamento)
                                    <p style="font-weight: bold; color:green; font-size:13px; margin-top: 5px"> Termina {{$produto->dt_fechamento}} às {{$produto->hh_fechamento}}</p>
                                @else
                                    <p style="font-weight: bold; color:gray; font-size:13px; margin-top: 5px"> </p>
                                @endif
                            @endif
                        </div>

                    </div>
                </div>
            </div>
        @endif
    @endif
@endforeach
</div>

@include('modais')


<script>
    function CadastrarProduto() {
        alert('CadastrarProduto');
    }

    function AbrirLoja() {
        alert('AbrirLoja');
    }

    function NovoProduto(idProd) {
        console.log('Novo Produto');

        //realiza busca no servidor usando a rota /NovoProduto
         $.ajax({
            data: {
                '_token': "{{ csrf_token() }}",
                idProd: idProd,
            },
            url: 'NovoProduto',
            method: 'post',
            dataType: "json",
            success: function(result) {

                console.log(result);
                document.location.reload();
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                alert('Favor verificar as informações e Tentar novamente');
            }
        });

    }

    function comprarProduto(idProd) {
        alert('Comprar Produto ' + idProd);

        //realiza busca no servidor usando a rota /ComprarProduto
        $.ajax({
            data: {
                '_token': "{{ csrf_token() }}",
                idProd: idProd,
            },
            url: 'ComprarProduto',
            method: 'post',
            dataType: "json",
            success: function(result) {

                console.log(result);
                document.location.reload();

            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                //document.location.reload();
                alert('Favor verificar as informações e Tentar novamente');
            }
        });
    }

    function salvarReacao(idProd) {

        //realiza busca no servidor usando a rota /SalvarProduto
        $.ajax({
            data: {
                '_token': "{{ csrf_token() }}",
                idProd: idProd,
            },
            url: 'SalvarReacao',
            method: 'post',
            dataType: "json",
            success: function(result) {

                console.log(result);
                document.location.reload();

            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                document.location.reload();
                //alert('Favor verificar as informações e Tentar novamente');
            }
        });
    }

    function removerReacao(idProd) {

        //realiza busca no servidor usando a rota /SalvarProduto
        $.ajax({
            data: {
                '_token': "{{ csrf_token() }}",
                idProd: idProd,
            },
            url: 'removerReacao',
            method: 'post',
            dataType: "json",
            success: function(result) {

                console.log(result);
                document.location.reload();
                //Location.reload()

            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                document.location.reload();
                //alert('Favor verificar as informações e Tentar novamente');
            }
        });
    }

    $('.btn-menu').click(function(){
        $('.menu').toggleClass('menu-aberto');
        $('.btn-menu').toggleClass('btn-aberto');
    });
    $('.menu ul li').click(function(){
        if ($(this).has('ul').length) {
            $(this).find('ul').slideToggle();
        }
    });

</script>
