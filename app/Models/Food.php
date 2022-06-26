<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    protected $table = 'foods';

    protected $fillable = [
        'name',
    ];
    public function clients() {
        return $this->belongsToMany('App\Models\Client','client_foods');
    }
}
