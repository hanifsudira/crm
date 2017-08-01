<?php

namespace App\Http\Controllers;
use App\Oracexcel;
use App\Oracount;
use Yajra\Datatables\Datatables;
use Excel;

class OraController extends Controller
{
    //full status
    public function index(){
        $lastupdate = Oracexcel::select('lastupdate')->first();
        $lastupdate = $lastupdate->lastupdate? $lastupdate->lastupdate : 'Unknown';
        return view('dashboard.oraexcel',['lastupdate'=> $lastupdate]);
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

    //count
    public function oracount(){
        $lastupdate = Oracount::select('lastupdate')->first();
        $lastupdate = $lastupdate->lastupdate !=null ? $lastupdate->lastupdate : 'Unknown';
        $data = Oracount::all();
        return view('dashboard.oracount',['data'=>$data, 'lastupdate'=> $lastupdate]);
    }

    //force
    public function forceexcel(){
        $command = escapeshellcmd('/usr/bin/python /var/www/html/crm/public/scripts/geto.py');
        shell_exec($command);
        redirect('force.oraexcel');
    }

    public function forcecount(){
        $command = escapeshellcmd('/usr/bin/python /var/www/html/crm/public/scripts/getc.py');
        shell_exec($command);
        redirect('force.oracount');
    }

}
