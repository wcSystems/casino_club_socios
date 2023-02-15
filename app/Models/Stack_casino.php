<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stack_casino extends Model
{
    protected $fillable = [
        'cantidad',
        'mesas_casino_id',
        'fichas_casino_id',
    ];
}
