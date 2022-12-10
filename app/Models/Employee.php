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
   

    public function group_schedule() {
        return $this->hasMany('App\Models\Schedule_template','employee_id')->selectRaw('year, month, employee_id')->groupBy('year','month','employee_id')->orderBy('year','desc')->orderBy('month','desc');
    }
    public function schedule_templates() {
        return $this->hasMany('App\Models\Schedule_template','employee_id');
    }

}
