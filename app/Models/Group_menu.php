<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Group_menu extends Model
{
    protected $fillable = [
        'name',
    ];

    public function items() {
        return $this->hasMany('App\Models\Ayb_item');
    }

}
