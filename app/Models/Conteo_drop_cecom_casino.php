<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Conteo_drop_cecom_casino extends Model
{
    protected $fillable = [
        'group_drops_casino_id',
        'mesas_casino_id',
        'billetes_casino_id',
        'cantidad',
    ];
}
