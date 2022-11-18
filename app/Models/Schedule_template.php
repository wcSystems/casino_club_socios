<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule_template extends Model
{
    protected $fillable = [
        'employee_id',
        'hora_entrada',
        'horas_trabajo',
        'turno',
        'year',
        'month',
        'day',
        'date',
    ];
}
