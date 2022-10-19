<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'employeeNo',
        'name',
        'nacimiento',
        'sex_id',
        'department_id',
        'sede_id',
        'position_id',
    ];
}
