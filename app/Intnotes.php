<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Intnotes extends Model
{
    protected $table = 'int_report_notes';

    protected $fillable = [
        'row_id',
        'fuby',
        'sby',
        'fus_note'
    ];
}
