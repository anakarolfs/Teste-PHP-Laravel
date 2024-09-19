<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\Models\Usuarios;
use App\Models\TbLanceLailaoModel;
use App\Models\TbLeilaoModel;

class LeilaoController extends Controller {

  public function SalvarLance(Request $request){

    //dd($request);
    $matricula = $_COOKIE['MATRICULA'];
    $data = date("Y-m-d H:i:s");

    $buscLeilao = TbLeilaoModel::select('ic_status', 'id_leilao')->where('id_produto',  $request->input('idProd'))
    ->orderby('ic_status')->get();
   
    if($buscLeilao[0]->ic_status == 2){

      $buscProd = TbLanceLailaoModel::where('id_produto',  $request->input('idProd'))->get()->toArray();

      if (count($buscProd) != 0) {
        TbLanceLailaoModel::where("id_produto", "=", $request->input('idProd'))
        ->update([
            'st_lance' => 0,
        ]);
      }

      $newLance = new TbLanceLailaoModel();
      $newLance->id_leilao = $buscLeilao[0]->id_leilao;
      $newLance->id_produto = $request->input('idProd');
      $newLance->vr_lance = $request->input('valorLance');
      $newLance->mat_lance = $matricula;
      $newLance->dt_lance =  $data;
      $newLance->st_lance = 1;
      $newLance->save();
    }
    return  $buscLeilao;
  
  }

  public function IniciarLeilao(Request $request){

    $matricula = $_COOKIE['MATRICULA'];
    $data = date("Y-m-d H:i:s");
    $dtFimLeilao = $request->input('dataFimLeilao') .' '. $request->input('horaFimLeilao').':00'; 
    //dd($dtFimLeilao);

    $newLeilao = new TbLeilaoModel();
    $newLeilao->id_produto = $request->input('idProd');
    $newLeilao->dh_abertura = $data;
    $newLeilao->dh_fechamento = $dtFimLeilao;
    $newLeilao->ic_status = 2;
    $newLeilao->dt_cadastro = $data;
    $newLeilao->mat_cadastro = $matricula;
    //dd($newLeilao);
    $newLeilao->save();

    return  $newLeilao;
  }

  public function CancelarLeilao(Request $request){

    $matricula = $_COOKIE['MATRICULA'];
    $data = date("Y-m-d H:i:s");
    //$dtFimLeilao = $request->input('dataFimLeilao') .' '. $request->input('horaFimLeilao').':00'; 
    //dd($dtFimLeilao);
    /*
    $result=TbLeilaoModel::where("id_produto", "=", $request->input('idProd'))->delete();
    $result=TbLanceLailaoModel::where("id_produto", "=", $request->input('idProd'))->delete();
    */
    
    TbLeilaoModel::where("id_produto", "=", $request->input('idProd'))
    ->update([
        'ic_status' => 4,
        'dt_alteracao' => $data,
        'mat_alteracao' => $matricula,
    ]); 

    return  $matricula;
  }

  
}
