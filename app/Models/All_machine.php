<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class All_machine extends Model
{
    protected $fillable = [
        'name',
        'sede_id',
        'brand_machine_id',
        'model_machine_id',
        'range_machine_id',
        'associated_machine_id',
        'value_machine_id',
        'play_machine_id',
    ];
}
