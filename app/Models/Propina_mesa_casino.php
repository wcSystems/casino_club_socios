<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Propina_mesa_casino extends Model
{
    protected $fillable = [
        'group_cierre_boveda_casino_id',
        'mesas_casino_id',
        'cantidad',
    ];
}
