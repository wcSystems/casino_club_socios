<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Conteo_drop_boveda_casino extends Model
{
    protected $fillable = [
        'group_cierre_boveda_id',
        'mesas_casino_id',
        'billetes_casino_id',
        'cantidad',
    ];
}
