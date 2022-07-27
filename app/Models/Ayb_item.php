<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ayb_item extends Model
{
    protected $fillable = [
        'name',
    ];

    public function commands() {
        return $this->belongsToMany('App\Models\Ayb_commands','ayb_commands');
    }
}
