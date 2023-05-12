<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bancada_sede_casino extends Model
{
    protected $fillable = [
        'cantidad',
        'fichas_casino_id',
        'sede_id',
    ];
}
