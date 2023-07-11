<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Clientes_casino extends Model
{
    protected $fillable = [
        'name',
        'sede_id',
        'clasificacion_cliente_casino_id',
        'sex_id',
        'description',
    ];
}
