<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Associated_machine extends Model
{
    protected $fillable = [
        'name',
        'associated_group_id'
    ];

    public function machines() {
        return $this->hasMany('App\Models\All_machine');
    }
}
