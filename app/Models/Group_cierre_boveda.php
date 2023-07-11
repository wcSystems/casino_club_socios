<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Group_cierre_boveda extends Model
{
    protected $fillable = [
        'created_at',
        'extra',
        'sede_id',
        'room_id',
    ];
}
