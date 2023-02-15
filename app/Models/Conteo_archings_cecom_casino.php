<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Conteo_archings_cecom_casino extends Model
{
    protected $fillable = [
        'group_archings_casino_id',
        'mesas_casino_id',
        'fichas_casino_id',
        'cantidad',
    ];
}
