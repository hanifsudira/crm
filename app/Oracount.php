<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Oracount extends Model
{
    protected $table = 'oracount';

    protected $fillable = [
        'STATUS_ORDER',
        'STATUS_FULFILLMENT',
        'MILESTONE',
        'JUMLAH',
        'lastupdate'
    ];
}
