<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lisummary extends Model
{
    protected $table = 'lineitem_summary';

    protected $fillable = [
        'OH_STATUS',
        'LI_STATUS',
        'MILESTONE',
        'JUMLAH',
        'lastupdate'
    ];
}
