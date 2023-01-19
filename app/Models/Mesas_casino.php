<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mesas_casino extends Model
{
    protected $fillable = [
        'name',
        'puestos',
        'sede_id',
    ];
}
