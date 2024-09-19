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

    Route::any('/EditarProduto', [ProdutosController::class, 'EditarProduto'])->name('EditarProduto'); //função Editar produto
    Route::any('/BuscarProduto', [ProdutosController::class, 'BuscarProduto'])->name('BuscarProduto'); //função Buscar produto

    Route::any('/ExcluirProduto', [ProdutosController::class, 'ExcluirProduto'])->name('ExcluirProduto'); //fun��o Excluir produto
    Route::any('/AtivarProduto', [ProdutosController::class, 'AtivarProduto'])->name('AtivarProduto'); //fun��o Ativar produto
    Route::any('/DesativarProduto', [ProdutosController::class, 'DesativarProduto'])->name('DesativarProduto'); //fun��o Desativar produto

    Route::any('/IniciarLeilao', [LeilaoController::class, 'IniciarLeilao'])->name('IniciarLeilao'); //função Iniciar leilão
    Route::any('/CancelarLeilao', [LeilaoController::class, 'CancelarLeilao'])->name('CancelarLeilao'); //função Iniciar leilão
    Route::any('/SalvarLance', [LeilaoController::class, 'SalvarLance'])->name('SalvarLance'); //função salvar Lance leilão

    Route::any('/SalvarReacao', [ProdutosController::class, 'SalvarReacao'])->name('SalvarReacao'); //função salvar Reação
    Route::any('/removerReacao', [ProdutosController::class, 'removerReacao'])->name('removerReacao'); //função remover Reação

    Route::get('/buscarSaldo', [PontosController::class, 'consultarSaldo'])->name('buscar-saldo');

    // VIEW INPUT PONTOS
    Route::get('/EditarPontuacoes', [PontosController::class, 'inputPontos'])->name('EditarPontuacoes');
    Route::get('/BuscaTipoBonusDeducao', [PontosController::class, 'buscarTiposBonusDeducao'])->name('BuscaTipoBonusDeducao');
    Route::get('/BuscarColaboradores', [PontosController::class, 'buscarColaboradores'])->name('BuscarColaboradores');
    Route::post('/SalvarDeducaoExtra', [PontosController::class, 'salvarDeducaoExtra'])->name('SalvarDeducaoExtra');
    Route::post('/SalvarBonificacaoExtra', [PontosController::class, 'salvarBonificacaoExtra'])->name('SalvarBonificacaoExtra');
});
