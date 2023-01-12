<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ayb_item_command extends Model
{
    protected $fillable = [
        'ayb_command_id',
        'ayb_item_id',
        'total',
        'table_id',
    ];

    public function items() {
        return $this->belongsToMany('App\Models\Ayb_item','ayb_items');
    }

    public function commands() {
        return $this->belongsToMany('App\Models\Ayb_comand','ayb_commands');
    }

}
