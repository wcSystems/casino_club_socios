<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule_template extends Model
{
    protected $fillable = [
        'employee_id',
        'year_month_group_id',
        'horario',
    ];

}
