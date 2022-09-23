<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ayb_item extends Model
{
    protected $fillable = [
        'name',
        'price',
    ];

    public function item() {
        return $this->belongsToMany('App\Models\Ayb_item_command','ayb_item_commands');
    }
}
