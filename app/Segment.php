<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Segment extends Model
{
    protected $table = 'segment';

    protected $fillable = [
        'AGREE_NUM',
        'AGREE_NAME',
        'REV',
        'STATUS',
        'TYPE',
        'START_DATE',
        'END_DATE',
        'NUM_PARENT',
        'REV_PARENT',
        'SEGMEN',
        'lastupdate'
    ];
}
