<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Oracexcel,App\Oracount,App\Lireport,App\Lisummary,App\Oreport,App\Osummary;
use Yajra\Datatables\Datatables;
use Excel;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class OraController extends Controller
{
    //full status
    public function index(){
        $data = $data = Oracount::all();
        $lastupdate = Oracexcel::select('lastupdate')->first();
        $lastupdate = $lastupdate->lastupdate? $lastupdate->lastupdate : 'Unknown';
        return view('dashboard.oraexcel',['data' => $data, 'lastupdate'=> $lastupdate]);
    }

    public function getora(){
        $data = Oracexcel::all();
        return Datatables::of($data)
            ->addColumn('action', function ($data) {
                return '<a target="_blank" href="' . route("ora.tomsom", Crypt::encryptString($data->ORDER_NUM)) . '" class="btn btn-block btn-xs btn-primary"><i class="glyphicon glyphicon-check"></i>Check</a>';
            })
            ->make(true);
    }

    public function downloadexcel(){
        $data =  Oracexcel::all()->toArray();
        return Excel::create('siebel_query', function($excel) use ($data) {
            $excel->sheet('mySheet', function($sheet) use ($data) {
                $sheet->fromArray($data);
            });
        })->download('xlsx');
    }

    public function tomsom($id){
        $order_num =  Crypt::decryptString($id);
        $postdata = http_build_query(array('search' => $order_num));
        $opts = array('http' =>
            array(
                'method'  => 'POST',
                'header'  => 'Content-type: application/x-www-form-urlencoded',
                'content' => $postdata
            )
        );
        $context  = stream_context_create($opts);
        $result = file_get_contents('http://10.65.10.212/reqi/tomsom/index.php?p=search',false, $context);

        $doc = new \DOMDocument();
        $doc->validateOnParse = true;
        libxml_use_internal_errors(true);
        $doc->loadHTML($result);
        $xpath = new \DOMXPath($doc);
        $table = $xpath->query("//*[@class='table table-striped table-bordered table-hover dataTables-example']");

        $noss = $table->item(0);
        $nossrows = $noss->getElementsByTagName("tr");
        $nossarr = array();
        foreach ($nossrows as $row) {
            $temp = array();
            $cells = $row->getElementsByTagName('td');
            foreach ($cells as $cell) {
                array_push($temp,$cell->nodeValue);
            }
            array_push($nossarr,$temp);
        }

        $realnossarr = array();
        for($i = 2;$i<sizeof($nossarr);$i++){
            array_push($realnossarr,$nossarr[$i]);
        }

        $tenoss = $table->item(1);
        $tenossrows = $tenoss->getElementsByTagName("tr");
        $tenossarr = array();
        foreach ($tenossrows as $row) {
            $temp = array();
            $cells = $row->getElementsByTagName('td');
            foreach ($cells as $cell) {
                array_push($temp,$cell->nodeValue);
            }
            array_push($tenossarr,$temp);
        }

        $realtenossarr = array();
        for($i = 2;$i<sizeof($tenossarr);$i++){
            array_push($realtenossarr,$tenossarr[$i]);
        }
        return view('dashboard.tomsom',['noss'=>$realnossarr, 'tenoss'=>$realtenossarr]);
    }

    //checkproduct
    public function checkproduct(){
        return view('dashboard.checkproduct');
    }

    public function getcheckproduct(Request $request){
        $ordernum = $request->order;
        $command = "/usr/bin/python /var/www/html/crm/public/scripts/getpro.py ".$ordernum;
        $output = shell_exec($command);
        $output = json_decode($output);
        return view('dashboard.prodajax',['data' => $output]);
    }

    //checkorder
    public function checkorder(){
        return view('dashboard.checkorder');
    }

    public function getcheckorder(Request $request){
        $ordernum = $request->order;
        $command = "/usr/bin/python /var/www/html/crm/public/scripts/getwp.py ".$ordernum;
        $output = shell_exec($command);
        $output = json_decode($output);
        return view('dashboard.coajax',['data' => $output]);
    }

    //line item
    public function lineitem(){
        $lisummary = Lisummary::all();
        $luli = $lisummary[0]->lastupdate;
        $lastupdate = DB::select('select lastupdate from int_report limit 1')[0];
        $lastupdate = $lastupdate->lastupdate !=null ? $lastupdate->lastupdate : 'Unknown';
        return view('dashboard.lineitem',['lisummary' => $lisummary, 'lastupdate' => $lastupdate,'luli'=>$luli]);
    }

    public function getlireport(){
        return Datatables::of(Lireport::all())->make(true);
    }

    public function downloadexcelli(){
        $data =  Lireport::all()->toArray();
        return Excel::create('line_item', function($excel) use ($data) {
            $excel->sheet('mySheet', function($sheet) use ($data) {
                $sheet->fromArray($data);
            });
        })->download('xlsx');
    }

    //order
    public function order(){
        $osummary = Osummary::all();
        $lastupdate = Osummary::select('lastupdate')->first();
        $lastupdate = $lastupdate->lastupdate !=null ? $lastupdate->lastupdate : 'Unknown';
        return view('dashboard.order',['osummary' => $osummary, 'lastupdate' => $lastupdate]);
    }

    public function getoreport(){
        return Datatables::of(Oreport::all())->make(true);
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

    //nossf-tenoss
    public function nossftenoss(){
        return view('dashboard.nossftenoss');
    }

    //nossf-tenoss
    public function getnossftenoss(){
        $command = "/usr/bin/python /var/www/html/crm/public/scripts/getnt.py";
        $output = shell_exec($command);
        $output = json_decode($output, true);
        foreach($output as $subKey => $subArray){
            unset($subArray['#text']);
            $subArray['TSQ_STATE'] = is_string($subArray['TSQ_STATE']) ? $subArray['TSQ_STATE'] : 'None';
            $subArray['TSQ_DESC'] = is_string($subArray['TSQ_DESC']) ? $subArray['TSQ_DESC'] : 'None';
            $subArray['DELIVER_STATE'] = is_string($subArray['DELIVER_STATE']) ? $subArray['DELIVER_STATE'] : 'None';
            $subArray['DELIVER_DESC'] = is_string($subArray['DELIVER_DESC']) ? $subArray['DELIVER_DESC'] : 'None';
            $output[$subKey] = $subArray;
        }
        return Datatables::of($output)->make(true);
    }

    //com
    public function getcom(){
        $com = file_get_contents('http://10.65.10.212/reqi/comaia/json.php?crmid=all',false);
        $com = json_decode($com,true);
        $ordnumquery = Oracexcel::select('ORDER_NUM')->groupBy('ORDER_NUM')->get()->toArray();

        $allcom = array();
        foreach ($ordnumquery as $d){
            $ordernum = $d['ORDER_NUM'];

            if (array_key_exists($ordernum,$com)){
                $temp = array(
                    'ID'    => $d['ORDER_NUM'],
                    'ORD_CREATION_DATE' => $com[$ordernum]['ORD_CREATION_DATE'],
                    'ORD_COMPLETION_DATE' => $com[$ordernum]['ORD_COMPLETION_DATE'] == '31-DEC-99' ? 'Process' : $com[$ordernum]['ORD_COMPLETION_DATE'],
                    'TASK_MNEMONIC' => $com[$ordernum]['TASK_MNEMONIC'],
                );
                array_push($allcom,$temp);
            }
        }
        return Datatables::of($allcom)->make(true);
    }

    public function com(){
        return view('dashboard.com');
    }


    public function exploreora(){
        $users = DB::connection('oracle')->select('select status status_order, moli_fulfillment_status status_fulfillment,moli_milestone milestone, count(*) jumlah from (select t2.order_num, t4.attrib_05 as order_subtype , t2.status_cd as status, t1.row_id as moli_row_id, to_char(t1.created+7/24, \'dd-Mon-yyyy hh24:mi:ss\') as moli_created_dt, to_char(t1.last_upd+7/24, \'dd-Mon-yyyy hh24:mi:ss\') as moli_last_updated_dt, t3.name as moli_product_name, t1.status_cd as moli_status, t1.fulflmnt_status_cd as moli_fulfillment_status, t1.milestone_code as moli_milestone, t1.service_num as moli_service_id, t1.asset_integ_id as moli_asset_integ_id, t1.x_bill_start_dt as moli_bill_start_dt, t5.agree_num as moli_agree_num from sblprd.s_order_item t1 inner join sblprd.s_order t2 on t2.row_id = t1.order_id inner join sblprd.s_prod_int t3 on t3.row_id = t1.prod_id inner join sblprd.s_order_x t4 on t4.par_row_id = t2.row_id left outer join sblprd.s_doc_agree t5 on t5.row_id = t1.agree_id where t1.row_id = t1.root_order_item_id and t1.status_cd not in(\'Abandoned\',\'Cancelled\') and t2.rev_num = (select max(rev_num) from sblprd.s_order x where x.order_num = t2.order_num and x.status_cd not in (\'Abandoned\',\'x\'))) group by status, moli_milestone, moli_fulfillment_status order by 1');
        var_dump($users);
    }
}
