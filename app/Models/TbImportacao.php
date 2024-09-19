<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TbImportacao extends Model
{
    protected $table = 'programa_pontos.tb_importacao';
    public $timestamps = false;
    protected $primaryKey = 'co_importacao';
}
