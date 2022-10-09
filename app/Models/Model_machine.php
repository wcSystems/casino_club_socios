<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Model_machine extends Model
{
    protected $fillable = [
        'brand_machine_id',
        'name',
    ];

    public function machines() {
        return $this->hasMany('App\Models\All_machine');
    }
}
