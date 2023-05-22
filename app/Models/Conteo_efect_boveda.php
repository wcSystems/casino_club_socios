<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Conteo_efect_boveda extends Model
{
    protected $fillable = [
        'group_cierre_boveda_casino_id',
        'billetes_casino_id',
        'cantidad',
    ];
}
