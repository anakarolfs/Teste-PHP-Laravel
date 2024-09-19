<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\Models\Usuarios;
use App\Models\TbProdutosModel;
use App\Models\TbListaDesejosModel;
use App\Models\TbProdutosModelLog;

class ProdutosController extends Controller
{

    public function homeProduto()
    {
        //echo '<pre>'.print_r($lista,true).'</pre>';
        //return view ('qualidade/listarMusicas');
        $matriculaLog = $_COOKIE['MATRICULA'];
        $nomeLog = DB::table('portal.vw_empregados')->select('nome', 'login_dac')->where('login_dac', $matriculaLog)->first();
        //dd($nomeLog );

        $statusLoja = DB::table('programa_pontos.vw_loja_aberta')
        ->select('lj_aberta')->get(); 

        $adm = DB::table('programa_pontos.tb_adms')->select('status')
        ->where('mt_usuario', $_COOKIE['MATRICULA'])->where('status', 1)->get(); 

        $listProdutos1 = TbProdutosModel::select('id_produto', 'no_produto', 'de_produto', 'img_produto', 'qt_estoque', 'vr_produto', 'dt_cadastro')
            ->orderBy('id_produto')->get(); //->paginate(10);

        /*
        $moedasOld = DB::table('programa_pontos.tb_moedas_usuario')
            ->select('mat_usuario', 'total_moedas')
            ->where('mat_usuario', $_COOKIE['MATRICULA'])
            ->whereRaw(DB::raw("dt_moeda = current_date -1"))
            ->orderBy('mat_usuario')->get(); //->paginate(10);
        //  dd($moedas); */

        $moedas = DB::table('programa_pontos.vw_moedas_usuario')
            ->select('mat_usuario', 'qt_moedas_anterior', 'total_moedas', 'de_nivel_experiencia')
            ->where('mat_usuario', $_COOKIE['MATRICULA'])
            ->get();
        
        $desejos = TbListaDesejosModel::select('st_desejos', 'id_produto')
            ->where('mat_inclusao', $_COOKIE['MATRICULA'])
            ->where('st_desejos', 1)
            ->orderBy('mat_inclusao')->get();

        /* ----------------- OLD -----------------
        $listProdutos = DB::table('programa_pontos.vw_produtos as prod')
            ->select(
                'prod.id_produto',
                'no_produto',
                'de_produto',
                'img_produto',
                'qt_estoque',
                'vr_produto',
                DB::raw("max(vr_lance) as vr_lance"),
                DB::raw("count(vr_lance) as total_lance"),
                //'dt_cadastro',
                'st_produto',
                'ic_status',
                'dh_fechamento as diaFechamento',
                DB::raw("coalesce(st_desejos, 0) as st_desejos"),
                DB::raw("to_char(dh_abertura, 'DD/MM/YYYY HH24:MI:SS') as dh_abertura"),
                DB::raw("to_char(dh_fechamento, 'DD/MM/YYYY HH24:MI:SS') as dh_fechamento"),
                DB::raw("to_char(dh_abertura, 'HH24:MI:SS') as hh_abertura"),
                DB::raw("to_char(dh_fechamento, 'HH24:MI:SS') as hh_fechamento"),
                DB::raw("to_char(dh_abertura, 'DD/MM/YYYY') as dt_abertura"),
                DB::raw("to_char(dh_fechamento, 'DD/MM/YYYY') as dt_fechamento"),
            )
            ->leftJoin("programa_pontos.tb_lista_desejos as des", function ($join) {
                $join->on("des.id_produto", "=", "prod.id_produto");
                $join->on("des.mat_inclusao", "=", DB::raw("'" . $_COOKIE['MATRICULA'] . "'"));
            })
            ->leftJoin("programa_pontos.tb_lance_leilao as lei", "lei.id_produto", "=", "prod.id_produto")
            ->leftJoin("programa_pontos.tb_leilao as dtlei", "dtlei.id_produto", "=", "prod.id_produto")
            ->orderBy('st_desejos', 'desc')->orderBy('st_produto', 'desc')->orderBy('qt_estoque', 'desc')->orderBy('vr_produto', 'asc')
            ->groupBy('prod.id_produto', 'no_produto', 'de_produto', 'img_produto', 'ic_status',
            'qt_estoque', 'vr_produto', 'st_produto', 'st_desejos', 'dh_abertura', 'dh_fechamento')
            ->distinct()
            ->get(); //->paginate(10);
            //->toSql();
            */

        $listProdutos = DB::table('programa_pontos.vw_produtos')
                    ->select(
                        'id_leilao', 'id_produto', 'no_produto', 'de_produto', 'img_produto'
                        , 'qt_estoque', 'vr_produto', 'vr_lance', 'mat_lance', 'total_lance', 'st_produto'
                        , 'ic_status', 'diafechamento', 'st_desejos', 'dh_abertura', 'dh_fechamento', 'hh_abertura'
                        , 'hh_fechamento', 'dt_abertura', 'dt_fechamento', 'nome'
                    )
                    ->leftJoin("portal.vw_empregados", "login_dac", "=",  DB::raw("CAST(mat_lance AS INTEGER)"))
                    ->orderBy('st_desejos', 'desc')->orderBy('st_produto', 'desc')->orderBy('qt_estoque', 'desc')->orderBy('vr_produto', 'asc')
                    //->distinct()
                    ->get(); //->paginate(10);
                    //->toSql();
       // dd($listProdutos);

        return view('home', compact('listProdutos', 'moedas', 'statusLoja', 'desejos', 'adm', 'nomeLog'));
    }

    public function SalvarProduto(Request $request)
    {

        //dd($request);
        $matricula = $_COOKIE['MATRICULA'];
        $data = date("Y-m-d H:i:s");

        $file = $request->file('anexoPDF');
        $imgProd = $file->getClientOriginalName();

        //$caminho = realpath ('produtos/'.$filaselecionada[0]->nome);
        //$teaser_image = time().'.'.$file->getClientOriginalExtension();
        //$destinationPath = public_path('/produtos');

        $caminho = realpath('produtos/');
        $file->move($caminho, $file->getClientOriginalName());

        $newProduto = new TbProdutosModel();
        $newProduto->no_produto = $request->input('nomeProd');
        $newProduto->de_produto = $request->input('deProd');
        $newProduto->img_produto = $imgProd;
        //$newProduto->img_produto ='materiaisFilas/'.$filaselecionada[0]->nome.'/'.$file->getClientOriginalName();
        $newProduto->qt_estoque = $request->input('quantEstoqProd');
        $newProduto->id_categoria_venda = 2;
        $newProduto->vr_produto = $request->input('valorProd');
        $newProduto->st_produto = 0;
        $newProduto->dt_cadastro = $data;
        $newProduto->mat_cadastro = $matricula;

        // dd($newProduto);
        $newProduto->save();
    }

    public function EditarProduto(Request $request){
        $matricula = $_COOKIE['MATRICULA'];
        $data = date("Y-m-d H:i:s");

        $buscaProduto = TbProdutosModel::where("id_produto", "=", $request->input('idProdEdit'))->get();
        //dd($buscaProduto[0]->id_produto);

        $ProdutoLog = new TbProdutosModelLog();
        $ProdutoLog->id_produto = $buscaProduto[0]->id_produto;
        $ProdutoLog->no_produto = $buscaProduto[0]->no_produto;
        $ProdutoLog->de_produto = $buscaProduto[0]->de_produto;
        $ProdutoLog->img_produto = $buscaProduto[0]->img_produto;
        $ProdutoLog->qt_estoque = $buscaProduto[0]->qt_estoque;
        $ProdutoLog->id_categoria_venda = $buscaProduto[0]->id_categoria_venda;
        $ProdutoLog->vr_produto = $buscaProduto[0]->vr_produto;
        $ProdutoLog->st_produto = 0;
        $ProdutoLog->dt_cadastro = $buscaProduto[0]->dt_cadastro;
        $ProdutoLog->mat_cadastro = $buscaProduto[0]->mat_cadastro;
        $ProdutoLog->dt_alteracao = $buscaProduto[0]->dt_alteracao;
        $ProdutoLog->mat_alteracao = $buscaProduto[0]->mat_alteracao;
        $ProdutoLog->save();

        TbProdutosModel::where("id_produto", "=", $request->input('idProdEdit'))
                ->update([
                    'no_produto' => $request->input('nomeProdEdit'),
                    'de_produto' => $request->input('deProdEdit'),
                    'vr_produto' => $request->input('valorProdEdit'),
                    'dt_alteracao' => $data,
                    'mat_alteracao' => $matricula,
                ]);

        return $buscaProduto;
    }

    public function NovoProduto(Request $request){
        $matricula = $_COOKIE['MATRICULA'];
        $data = date("Y-m-d H:i:s");

        $buscaProduto = TbProdutosModel::where("id_produto", "=", $request->input('idProd'))->get();
       // dd($buscaProduto[0]->id_produto);

        $ProdutoLog = new TbProdutosModel();
        $ProdutoLog->no_produto = $buscaProduto[0]->no_produto;
        $ProdutoLog->de_produto = $buscaProduto[0]->de_produto;
        $ProdutoLog->img_produto = $buscaProduto[0]->img_produto;
        $ProdutoLog->qt_estoque = $buscaProduto[0]->qt_estoque;
        $ProdutoLog->id_categoria_venda = $buscaProduto[0]->id_categoria_venda;
        $ProdutoLog->vr_produto = $buscaProduto[0]->vr_produto;
        $ProdutoLog->st_produto = 0;
        $ProdutoLog->dt_cadastro = $data;
        $ProdutoLog->mat_cadastro = $matricula;

        $ProdutoLog->save();

        return $buscaProduto;
    }

    public function ExcluirProduto(Request $request){

        $id = $request->input('idProd'); 

        $buscaProduto = TbProdutosModel::where("id_produto", "=", $id)->get();

        $ProdutoLog = new TbProdutosModelLog();
        $ProdutoLog->id_produto = $buscaProduto[0]->id_produto;
        $ProdutoLog->no_produto = $buscaProduto[0]->no_produto;
        $ProdutoLog->de_produto = $buscaProduto[0]->de_produto;
        $ProdutoLog->img_produto = $buscaProduto[0]->img_produto;
        $ProdutoLog->qt_estoque = $buscaProduto[0]->qt_estoque;
        $ProdutoLog->id_categoria_venda = $buscaProduto[0]->id_categoria_venda;
        $ProdutoLog->vr_produto = $buscaProduto[0]->vr_produto;
        $ProdutoLog->st_produto = 0;
        $ProdutoLog->dt_cadastro = $buscaProduto[0]->dt_cadastro;
        $ProdutoLog->mat_cadastro = $buscaProduto[0]->mat_cadastro;
        $ProdutoLog->dt_alteracao = $buscaProduto[0]->dt_alteracao;
        $ProdutoLog->mat_alteracao = $buscaProduto[0]->mat_alteracao;
        $ProdutoLog->save();
  
        $filaselecionada = TbProdutosModel::select('img_produto')->where('id_produto',$id)->get();
        $caminho = 'produtos/' . $filaselecionada[0]->img_produto;
 
     // echo '<pre>'.print_r($caminho, true).'</pre>';
       unlink($caminho); 
   
       TbProdutosModel::where('id_produto', $id)
        ->delete();
   
        return $filaselecionada;
    }

    public function AtivarProduto(Request $request){
        $matricula = $_COOKIE['MATRICULA'];
        $data = date("Y-m-d H:i:s");

        TbProdutosModel::where("id_produto", "=", $request->input('idProd'))
                ->update([
                    'st_produto' => 1,
                    'dt_alteracao' => $data,
                    'mat_alteracao' => $matricula,
                ]);
        return $matricula;
    }

    public function DesativarProduto(Request $request){
        $matricula = $_COOKIE['MATRICULA'];
        $data = date("Y-m-d H:i:s");
        
        TbProdutosModel::where("id_produto", "=", $request->input('idProd'))
                ->update([
                    'st_produto' => 0,
                    'dt_alteracao' => $data,
                    'mat_alteracao' => $matricula,
                ]);
        return $matricula;
    }

    public function BuscarProduto(Request $request)
    {
        $idProd = $request->input('idProd');

        //$tableProdutos = new TbProdutosModel();
        //$pesqMusicas = $musica->buscar($dataAbertura, $dataFim);
        $infoLances = DB::table('programa_pontos.tb_lance_leilao as lanc')
            ->select('id_lances_leilao', 'lanc.id_leilao', 'vr_lance', 'mat_lance', 'lanc.id_produto', 'nome', 
            DB::raw("to_char(dt_lance, 'DD/MM/YYYY HH24:MI:SS') as dt_lance")
            )
            ->leftJoin("programa_pontos.tb_leilao as lei", "lei.id_leilao", "=", "lanc.id_leilao")
            ->leftJoin("portal.vw_empregados", "login_dac", "=",  DB::raw("CAST(mat_lance AS INTEGER)"))
            ->where('lanc.id_produto', $idProd)
            ->where('ic_status', 2)
            ->orderBy('vr_lance', 'desc')
            ->limit(3)
            ->get(); 
       
        $infoProduto = DB::table('programa_pontos.vw_produtos')
            ->select(
                'id_leilao', 'id_produto', 'no_produto', 'de_produto', 'img_produto'
                , 'qt_estoque', 'vr_produto', 'vr_lance', 'mat_lance', 'total_lance', 'st_produto'
                , 'ic_status', 'diafechamento', 'st_desejos', 'dh_abertura', 'dh_fechamento', 'hh_abertura'
                , 'hh_fechamento', 'dt_abertura', 'dt_fechamento'
            )
            ->where('id_produto', $idProd)->where('ic_status', 2)
            ->get(); 
            //->toSql();

           // dd($infoLances);
        return json_encode(["data" => $infoProduto, "lance" => $infoLances]);
    }

    public function BuscarProdutoEdit(Request $request)
    {
        $idProd = $request->input('idProd');

        //$tableProdutos = new TbProdutosModel();
        //$pesqMusicas = $musica->buscar($dataAbertura, $dataFim);
        
        $infoProduto =  DB::table('programa_pontos.tb_produtos as prod')
            ->select('prod.id_produto', 'no_produto', 'de_produto', 'img_produto', 'qt_estoque', 'vr_produto', 'dt_cadastro', DB::raw("max(vr_lance) as vr_lance"))
            ->leftJoin("programa_pontos.tb_lance_leilao as lei", "lei.id_produto", "=", "prod.id_produto")
            ->where('prod.id_produto', $idProd)->orderBy('dt_lance', 'desc')
            ->groupBy('prod.id_produto', 'no_produto', 'de_produto', 'img_produto', 'qt_estoque', 'vr_produto', 'dt_cadastro', 'dt_lance')->get(); //->paginate(10);
        
     
           // dd($infoProduto);
        return json_encode(["data" => $infoProduto]);
    }

    public function ComprarProduto(Request $request)
    {
        $buscProduto = TbProdutosModel::select('qt_estoque')->where('id_produto',  $request->input('idProd'))
            //->where('mat_inclusao', $_COOKIE['MATRICULA'])
            ->get();//->toArray();

        //dd($buscProduto[0]->qt_estoque);
        if($buscProduto[0]->qt_estoque > 0){
            dd($buscProduto[0]->qt_estoque);
        }else{
            dd('Esgotado');
        }
    }

    public function SalvarReacao(Request $request)
    {

        //dd($request);
        $matricula = $_COOKIE['MATRICULA'];
        $data = date("Y-m-d H:i:s");

        $buscDesejo = TbListaDesejosModel::where('id_produto',  $request->input('idProd'))
            ->where('mat_inclusao', $_COOKIE['MATRICULA'])->get()->toArray();
        // dd(count($buscDesejo));

        if (count($buscDesejo) == 0) {

            $newReacao = new TbListaDesejosModel();
            $newReacao->id_produto = $request->input('idProd');
            $newReacao->mat_inclusao = $matricula;
            $newReacao->dt_inclusao =  $data;
            $newReacao->st_desejos = 1;

            //dd($newReacao);
            $newReacao->save();
        } else {
            TbListaDesejosModel::where("id_produto", "=", $request->input('idProd'))
                ->update([
                    'st_desejos' => 1,
                    'dt_inclusao' => $data,
                    'mat_inclusao' => $matricula,
                ]);
        }

        return 'save';
    }

    public function removerReacao(Request $request)
    {

        TbListaDesejosModel::where("id_produto", "=", $request->input('idProd'))
            ->where('mat_inclusao', $_COOKIE['MATRICULA'])
            ->update([
                'st_desejos' => 0,
            ]);

        return 'save';
    }
}
