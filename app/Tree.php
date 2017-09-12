<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tree extends Model
{
    protected $table = 'tree';

    protected $fillable = [
        'CA_ID',
        'AGG_ID',
        'SITE',
        'AGG_NAME',
        'AGG_NUM',
        'REV_NUM',
        'PARENT',
        'PRODUCT',
        'AGG_TYPE',
        'PROD',
        'lastupdate'
    ];
}
