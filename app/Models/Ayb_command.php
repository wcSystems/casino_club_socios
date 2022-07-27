<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ayb_command extends Model
{
    protected $fillable = [
        'ayb_item_id',
        'total',
        'option',
        'game',
    ];

    public function items() {
        return $this->belongsToMany('App\Models\Ayb_items','ayb_items');
    }
}
