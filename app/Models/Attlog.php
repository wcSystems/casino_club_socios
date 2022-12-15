<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attlog extends Model
{
    protected $table = 'attlogs';

    protected $fillable = [
        'serialNo',
        'name',
        'time',
        'employeeNoString',
        'pictureURL',
        'facePictureUser'
    ];
}
