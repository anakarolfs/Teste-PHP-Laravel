<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TbDeducaoDia extends Model
{
    protected $table = 'programa_pontos.tb_deducao_dia';
    public $timestamps = false;
    protected $primaryKey = 'id_deducao_dia';
}
