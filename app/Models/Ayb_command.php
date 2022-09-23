<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ayb_command extends Model
{
    protected $fillable = [
        'user_id',
    ];

    public function command() {
        return $this->belongsToMany('App\Models\Ayb_item_command','ayb_item_commands');
    }
}
