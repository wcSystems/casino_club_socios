<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [
        'name',
        'last_name',
        'f_nac',
        'email',
        'address',
        'phone',
        'cedula',
        'sede_id',
    ];
    
}
