<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class vwEmpregadosModel extends Model
{
    //use HasFactory;
    protected $table = 'portal.vw_empregados';
    public $timestamps = false;
    protected $primaryKey = 'login';
}
