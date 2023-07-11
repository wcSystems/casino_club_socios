<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Conteo_drop_boveda_mesa_casino extends Model
{
    protected $fillable = [
        'group_cierre_boveda_id',
        'global_warehouse_id',
        'billetes_casino_id',
        'cantidad',
    ];
}
