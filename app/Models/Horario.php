<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    protected $fillable = [
        'name',
        'leyenda',
        'hora_entrada',
        'hora_trabajo',
    ];
}
