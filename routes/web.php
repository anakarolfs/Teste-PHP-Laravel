<?php



//namespace App\Http\Controllers\API;

use Illuminate\Support\Facades\Route;
//use App\Http\Controllers\Controller;
//use App\Http\Controllers\API\PostController;

use App\Http\Controllers\PontosController;
use App\Http\Controllers\ProdutosController;
use App\Http\Controllers\LeilaoController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/login', function () { return view('login'); });
//Route::get('/login', 'Portal\MainController@login')->name('login_portal');
Route::any('/login', [PontosController::class, 'login'])->name('login');
Route::any('/validarUsuario', [PontosController::class, 'validarUsuario'])->name('validarUsuario');

Route::middleware(['accessPortal'])->group(function () {

    //Route::get('/home', function () { return view('home'); })->name('home');
    Route::any('/', [ProdutosController::class, 'homeProduto'])->name('home');
    /*
    Route::get('/teste', function () { return view('Teste'); });  //netFlix // TESTE TELAS
    Route::get('/welcome', function () { return view('welcome'); })->name('welcome'); // TESTE TELAS
    */
    //Route::get('/cadProdutos', function () { return view('cadProdutos'); })->name('cadProdutos'); //tela Cadastrar Produto
    Route::any('/SalvarProduto', [ProdutosController::class, 'SalvarProduto'])->name('SalvarProduto'); //função salvar novo produto
    Route::any('/ComprarProduto', [ProdutosController::class, 'ComprarProduto'])->name('ComprarProduto'); //função Buscar produto
    Route::any('/NovoProduto', [ProdutosController::class, 'NovoProduto'])->name('NovoProduto'); //função salvar novo produto

    Route::any('/EditarProduto', [ProdutosController::class, 'EditarProduto'])->name('EditarProduto'); //função Editar produto
    Route::any('/BuscarProduto', [ProdutosController::class, 'BuscarProduto'])->name('BuscarProduto'); //função Buscar produto 
    Route::any('/BuscarProdutoEdit', [ProdutosController::class, 'BuscarProdutoEdit'])->name('BuscarProdutoEdit');

    Route::any('/ExcluirProduto', [ProdutosController::class, 'ExcluirProduto'])->name('ExcluirProduto'); //fun��o Excluir produto
    Route::any('/AtivarProduto', [ProdutosController::class, 'AtivarProduto'])->name('AtivarProduto'); //fun��o Ativar produto
    Route::any('/DesativarProduto', [ProdutosController::class, 'DesativarProduto'])->name('DesativarProduto'); //fun��o Desativar produto

    Route::any('/IniciarLeilao', [LeilaoController::class, 'IniciarLeilao'])->name('IniciarLeilao'); //fun��o Iniciar leil�o

    Route::any('/SalvarLance', [LeilaoController::class, 'SalvarLance'])->name('SalvarLance'); //fun��o salvar Lance leil�o

    Route::any('/SalvarReacao', [ProdutosController::class, 'SalvarReacao'])->name('SalvarReacao'); //função salvar Reação
    Route::any('/CancelarLeilao', [LeilaoController::class, 'CancelarLeilao'])->name('CancelarLeilao'); //função Iniciar leilão
    Route::any('/removerReacao', [ProdutosController::class, 'removerReacao'])->name('removerReacao'); //função remover Reação

    // BUSCA DE INFORMAÃƒâ€¡Ãƒâ€¢ES DO OPERADOR NA CAMPANHA PARA PREENCHIMENTO DO CABEÃƒâ€¡ALHO NA MAIN
    Route::get('/buscarSaldo', [PontosController::class, 'consultarSaldo'])->name('buscar-saldo');
    // VIEW INPUT PONTOS
    Route::get('/EditarPontuacoes', [PontosController::class, 'inputPontos'])->name('EditarPontuacoes');
    // BUSCA NAS TB_TIPO(DEDUÃƒâ€¡ÃƒÆ’O E BONIFICAÃƒâ€¡ÃƒÆ’O)
    Route::get('/BuscaTipoBonusDeducao', [PontosController::class, 'buscarTiposBonusDeducao'])->name('BuscaTipoBonusDeducao');
    // BUSCA DOS EMPREGADOS A RECEBER/PERDER PONTOS PARA DISPLAY DO RESUMO
    Route::get('/BuscarColaboradores', [PontosController::class, 'buscarColaboradores'])->name('BuscarColaboradores');
    // SALVAR PONTUAÃƒâ€¡Ãƒâ€¢ES EXTRAS
    Route::post('/SalvarDeducaoExtra', [PontosController::class, 'salvarDeducaoExtra'])->name('SalvarDeducaoExtra');
    Route::post('/SalvarBonificacaoExtra', [PontosController::class, 'salvarBonificacaoExtra'])->name('SalvarBonificacaoExtra');
    // BUSCAR EXTRATO DE PONTOS DO OPERADOR
    Route::get('/BuscarExtratoPontos', [PontosController::class, 'buscarExtratoPontos'])->name('BuscarExtratoPontos');
    // FILTRAR EXTRATO DE PONTOS DO OPERADOR
    Route::get('/FiltrarExtratoPontos', [PontosController::class, 'filtrarExtratoPontos'])->name('FiltrarExtratoPontos');
    // BUSCAR RESUMO GERAL DA CAMPANHA
    Route::get('/BuscarResumoGeralPontos', [PontosController::class, 'buscarResumoGeralPontos'])->name('BuscarResumoGeralPontos');
    // BUSCAR RELATÓRIO DE VENCEDORES
    Route::get('/BuscarVencedoresLeilao', [PontosController::class, 'buscarVencedoresLeilao'])->name('BuscarVencedoresLeilao');
});
