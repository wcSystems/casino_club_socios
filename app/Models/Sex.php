<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sex extends Model
{
    protected $table = 'sexs';

    protected $fillable = [
        'name',
    ];
}
