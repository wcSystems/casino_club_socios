<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Drink extends Model
{
    protected $fillable = [
        'name',
    ];
    public function clients() {
        return $this->belongsToMany('App\Models\Client','client_drinks');
    }
}
