<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usuarios extends Model
{
    
    protected $table = 'portal.usuarios';   
    protected $primaryKey = 'id_usuario';
    public $timestamps = false;

}

?>