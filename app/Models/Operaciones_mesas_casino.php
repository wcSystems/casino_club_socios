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
        
        'fill_1',
        'fill_2',
        'fill_3',
        'fill_cierre',

        'cred_1',
        'cred_2',
        'cred_3',
        'cred_cierre',

        'conteo_1',
        'conteo_2',
        'conteo_cierre',

        


    ];
}
