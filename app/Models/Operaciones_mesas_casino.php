<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Operaciones_mesas_casino extends Model
{
    protected $fillable = [
        'group_cierre_boveda_casino_id',
        'mesas_casino_id',
        'fichas_casino_id',
        'billetes_casino_id',
        
        'tipo',
        'cantidad',

        


    ];
}
