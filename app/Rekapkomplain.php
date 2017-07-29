<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rekapkomplain extends Model
{
    protected $table = 'crm';

    protected $fillable = [
        'id',
        'date',
        'sumber',
        'onsite_support',
        'nama_user',
        'nik_user',
        'user_login',
        'divisi',
        'no_telp',
        'no_quote',
        'no_order',
        'deskripsi_komplain',
        'kategori',
        'status',
        'assignee',
        'solusi'
    ];
}
