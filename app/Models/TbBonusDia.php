<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TbBonusDia extends Model
{
    protected $table = 'programa_pontos.tb_bonus_dia';
    public $timestamps = false;
    protected $primaryKey = 'id_bonus_dia';
}
