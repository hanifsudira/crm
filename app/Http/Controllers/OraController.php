<?php

namespace App\Http\Controllers;
use App\Oracexcel;
use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;

class OraController extends Controller
{
    public function index(){
        return view('dashboard.oraexcel');
    }

    public function getora(){
        return Datatables::of(Oracexcel::all())->make(true);
    }
}
