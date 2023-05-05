<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Conteo_arching_boveda_casino extends Model
{
    protected $fillable = [
        'group_cierre_boveda_id',
        'mesas_casino_id',
        'fichas_casino_id',
        'cantidad',
    ];
}
