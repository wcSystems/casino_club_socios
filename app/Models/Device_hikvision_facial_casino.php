<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Device_hikvision_facial_casino extends Model
{
    protected $fillable = [
        'local',
        'public',
        'password',
        'sede_id',
    ];
}
