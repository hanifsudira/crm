<?php

namespace App\Http\Controllers;
use App\Oracexcel;
use Yajra\Datatables\Datatables;
use Excel;

class OraController extends Controller
{
    public function index(){
        return view('dashboard.oraexcel');
    }

    public function getora(){
        return Datatables::of(Oracexcel::all())->make(true);
    }

    public function downloadexcel(){
        $data =  Oracexcel::all()->toArray();
        return Excel::create('siebel_query', function($excel) use ($data) {
            $excel->sheet('mySheet', function($sheet) use ($data) {
                $sheet->fromArray($data);
            });
        })->download('xlsx');
    }
}
