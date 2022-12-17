<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Global_warehouse extends Model
{
    protected $fillable = [
        'serial',
        'associated_machine_id',
        'brand_machine_id',
        'model_machine_id',
        'condicion',
        'room_id'
    ];

    public function history() {
        return $this->hasMany('App\Models\History_machine');
    }

    public function imgs() {
        return $this->hasMany('App\Models\Img_global_warehouse');
    }
}
