<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transportation extends Model
{
    protected $fillable = [
        'name',
    ];

    public function transportation_clients() {
        return $this->hasMany('App\Models\Client');
    }
}
