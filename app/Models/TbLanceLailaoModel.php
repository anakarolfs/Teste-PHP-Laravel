<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TbLanceLailaoModel extends Model
{
   protected $table = 'programa_pontos.tb_lance_leilao';
    public $timestamps = false;
    protected $primaryKey = 'id_lances_leilao';
/*
    public function buscar($dataAbertura, $dataFim)
    {
        //dd($dataAbertura);
        $buscar = TbProdutosModel::select('id_musica', 'matricula_caixa', 'nome_musica_banda', DB::RAW("to_char(data_inclusao, 'DD/mm/yyyy') as data_inclusao"))
            ->whereBetween('data_inclusao', [$dataAbertura, $dataFim])
            ->get()
            ->toArray();
        return $buscar;    
    }
*/
}
?>