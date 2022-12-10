<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Global_warehouse extends Model
{
    protected $fillable = [
        'name',
        'cod',
        'description',
        'shed_id',
    ];

    public function history() {
        return $this->hasMany('App\Models\History_machine');
    }
}
