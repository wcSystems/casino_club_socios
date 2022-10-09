<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand_machine extends Model
{
    protected $fillable = [
        'name',
    ];

    public function machines() {
        return $this->hasMany('App\Models\All_machine');
    }
}
