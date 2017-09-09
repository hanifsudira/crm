<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Oracexcel;
use function MongoDB\BSON\fromJSON;
use phpDocumentor\Reflection\Types\Null_;

class ReportController extends Controller
{

    public function query(){

    }

    public function allreport(){
        $lastupdate = DB::select('select lastupdate from int_report limit 1')[0];
        $pivot = DB::select('select li_status, milestone, 
                                count(case when ORDER_SUBTYPE=\'disconnect\' then 1 end) do,
                                count(case when ORDER_SUBTYPE=\'modify\' then 1 end) mo,
                                count(case when ORDER_SUBTYPE=\'new install\' then 1 end) ao,
                                count(case when ORDER_SUBTYPE=\'resume\' then 1 end) ro,
                                count(case when ORDER_SUBTYPE=\'suspend\' then 1 end) so
                            from int_report pt group by milestone,li_status');

        $pivotint = DB::select('select li_status_int, mile_status_int, count(*) as jumlah
                                from int_report 
                                group by mile_status_int,li_status_int order by li_status_int desc;');

        $status = ['Pending', 'Submitted', 'In Progress', 'In Progress', 'In Progress', 'In Progress', 'In Progress', 'Pending BASO', 'Pending BASO', 'Pending Billing Approval', 'Pending Billing Approval', 'Complete', 'Complete', 'Failed', 'Pending Cancel', 'Pending Cancel', 'Pending Cancel', 'Pending Cancel', 'Pending Cancel', 'Cancelled', 'Cancelled'];
        $milestone = ['None', 'None', 'None', 'SYNC CUSTOMER START', 'SYNC CUSTOMER COMPLETE', 'PROVISION START', 'PROVISION ISSUED', 'PROVISION COMPLETE', 'BASO STARTED', 'BILLING APPROVAL STARTED', 'FULFILL BILLING START', 'PROVISION COMPLETE', 'FULFILL BILLING COMPLETE', 'SYNC CUSTOMER START', 'None', 'SYNC CUSTOMER START', 'SYNC CUSTOMER COMPLETE', 'PROVISION START', 'PROVISION COMPLETE', 'None', 'SYNC CUSTOMER COMPLETE'];

        $return = array();
        $countverarr = array();
        $countverarrint = array();
        $countint = 0;
        for($i=0;$i<count($status);$i++){

            #db crm
            $state = 0;
            foreach ($pivot as $data){
                if($data->li_status==$status[$i] and $data->milestone==$milestone[$i]){
                    $state = 1;
                    array_push($return,$data);
                    $countver = $data->do+$data->mo+$data->ao+$data->ro+$data->so;
                    array_push($countverarr,$countver);
                    break;
                }
            }
            if(!$state){
                $temp = new \stdClass();
                $temp->li_status = $status[$i];
                $temp->milestone = $milestone[$i];
                $temp->do = 0;
                $temp->mo = 0;
                $temp->ao = 0;
                $temp->ro = 0;
                $temp->so = 0;
                array_push($return,$temp);
                array_push($countverarr,0);
            }

            #int
            $stateint = 0;
            foreach ($pivotint as $int){
                if($int->li_status_int==$status[$i] and $int->mile_status_int==$milestone[$i]){
                    $stateint = 1;
                    array_push($countverarrint,$int->jumlah);
                    $countint+=$int->jumlah;
                    break;
                }
            }
            if(!$stateint){
                array_push($countverarrint,0);
            }
        }

        $counthorarr = array();
        $counthorarr[0] = 0;$counthorarr[1] = 0;$counthorarr[2] = 0;$counthorarr[3] = 0;$counthorarr[4] = 0;
        foreach ($return as $r){
            $counthorarr[0] += $r->do;
            $counthorarr[1] += $r->mo;
            $counthorarr[2] += $r->ao;
            $counthorarr[3] += $r->ro;
            $counthorarr[4] += $r->so;
        }

        return view('report.allreport',['data'=>$return,'hor'=>$counthorarr,'ver'=>$countverarr,'countint'=>$countint,'verint'=>$countverarrint,'lu'=>$lastupdate->lastupdate]);
    }

    public function reviewtransaksi(){
        $command    = "/usr/bin/python /var/www/html/crm/public/scripts/getrt.py";
        $output     = shell_exec($command);
        $output     = json_decode($output);
        $lead       = $output[0];
        $quote      = $output[1];
        $agree      = $output[2];
        $order      = $output[3];
        return view('report.review',['lead'=>$lead,'quote'=>$quote,'agree'=>$agree,'order'=>$order]);
    }

    public function flowdatareturn(){
        $pivot = DB::select('select li_status, milestone, 
                                count(case when ORDER_SUBTYPE=\'disconnect\' then 1 end) do,
                                count(case when ORDER_SUBTYPE=\'modify\' then 1 end) mo,
                                count(case when ORDER_SUBTYPE=\'new install\' then 1 end) ao,
                                count(case when ORDER_SUBTYPE=\'resume\' then 1 end) ro,
                                count(case when ORDER_SUBTYPE=\'suspend\' then 1 end) so
                            from int_report pt group by milestone,li_status');

        $status = ['Pending', 'Submitted', 'In Progress', 'In Progress', 'In Progress', 'In Progress', 'In Progress', 'Pending BASO', 'Pending BASO', 'Pending Billing Approval', 'Pending Billing Approval', 'Complete', 'Complete', 'Failed', 'Pending Cancel', 'Pending Cancel', 'Pending Cancel', 'Pending Cancel', 'Pending Cancel', 'Cancelled', 'Cancelled'];
        $milestone = ['None', 'None', 'None', 'SYNC CUSTOMER START', 'SYNC CUSTOMER COMPLETE', 'PROVISION START', 'PROVISION ISSUED', 'PROVISION COMPLETE', 'BASO STARTED', 'BILLING APPROVAL STARTED', 'FULFILL BILLING START', 'PROVISION COMPLETE', 'FULFILL BILLING COMPLETE', 'SYNC CUSTOMER START', 'None', 'SYNC CUSTOMER START', 'SYNC CUSTOMER COMPLETE', 'PROVISION START', 'PROVISION COMPLETE', 'None', 'SYNC CUSTOMER COMPLETE'];

        $countverarr = array();
        for($i=0;$i<count($status);$i++){

            #db crm
            $state = 0;
            foreach ($pivot as $data){
                if($data->li_status==$status[$i] and $data->milestone==$milestone[$i]){
                    $state = 1;
                    $countver = $data->do+$data->mo+$data->ao+$data->ro+$data->so;
                    array_push($countverarr,$countver);
                    break;
                }
            }
            if(!$state){
                array_push($countverarr,0);
            }
        }

        $data = new \stdClass();
        $data->class                    = "go.GraphLinksModel";
        $data->copiesArrays             = true;
        $data->copiesArrayObjects       = true;
        $data->linkFromPortIdProperty   = "fromPort";
        $data->linkToPortIdProperty     = "toPort";
        $data->nodeDataArray            =  array(
            array(
                "name"=>"1.Pending : [?]",
                "leftArray"=> [
                    array(
                        "portId"=>"left0",
                        "portColor"=>"#000"
                    )
                ],
                "rightArray"=>[],
                "topArray"=>[],
                "bottomArray"=>[],
                "key"=>-3,
                "loc"=>"200 0",
                "color"=>"#203864",
                "width"=>"10",
                "height"=>"5"
            ),
            array(
                "name"=> "2.Submitted : [?]",
                "leftArray"=>[
                    array(
                        "portId"=>"left0",
                        "portColor"=>"#000"
                    ),
                ],
                "rightArray"=>[],
                "topArray"=>[],
                "bottomArray"=>[
                    array(
                        "portId"=>"bottom0",
                        "portColor"=>"#000"
                    ),
                ],
                "key"=>-4,
                "loc"=>"200 60",
                "color"=> "#203864",
                "width"=>"10",
                "height"=>"5"),
            array(
                "name"=>"1.Pending : [".(string)$countverarr[0]."]",
                "leftArray"=>[],
                "rightArray"=>[],
                "topArray"=>[],
                "bottomArray"=>[],
                "key"=>-5,
                "loc"=>"310 0",
                "color"=> "#2F5596",
                "width"=>"10",
                "height"=>"5"
            ),
            array(
                "name"=>"2.Submitted : [".(string)$countverarr[1]."]",
                "leftArray"=>[],
                "rightArray"=>[],
                "topArray"=>[],
                "bottomArray"=>[
                    array(
                        "portId"=>"bottom0",
                        "portColor"=>"#000"
                    ),
                ],
                "key"=>-6,
                "loc"=>"310 60",
                "color"=> "#2F5596",
                "width"=>"10",
                "height"=>"5"
            ),
            array(
                "name"=>"3.Inprogress : [?]",
                "leftArray"=>[],
                "rightArray"=>[],
                "topArray"=>[
                    array(
                        "portId"=>"top0",
                        "portColor"=>"#000"
                    ),
                ],
                "bottomArray"=>[],
                "key"=>-7,
                "loc"=>"200 310",
                "color"=> "#203864",
                "width"=>"10",
                "height"=>"17"
            ),
            array(
                "name"=>"17.Complete : [?]",
                "leftArray"=>[],
                "rightArray"=>[],
                "topArray"=>[],
                "bottomArray"=>[],
                "key"=>-8,
                "loc"=>"200 440",
                "color"=> "#203864",
                "width"=>"10",
                "height"=>"5"
            ),
            array(
                "name"=>"X.Pending Cancel",
                "leftArray"=>[
                    array(
                        "portId"=>"left0",
                        "portColor"=>"#000"
                    ),
                ],
                "rightArray"=>[],
                "topArray"=>[],
                "bottomArray"=>[],
                "key"=>-9,
                "loc"=>"200 500",
                "color"=> "#203864",
                "width"=>"10",
                "height"=>"5"
            ),
            array(
                "name"=>"17.Complete : \n[".(string)($countverarr[11]+$countverarr[12])."]",
                "leftArray"=>[],
                "rightArray"=>[
                    array(
                        "portId"=>"right0",
                        "portColor"=>"#000"
                    ),
                ],
                "topArray"=>[],
                "bottomArray"=>[],
                "key"=>-10,
                "loc"=>"310 440",
                "color"=> "#2F5596",
                "width"=>"10",
                "height"=>"5"
            ),
            array(
                "name"=>"X.Pending Cancel",
                "leftArray"=>[],
                "rightArray"=>[],
                "topArray"=>[],
                "bottomArray"=>[],
                "key"=>-11,
                "loc"=>"310 500",
                "color"=> "#2F5596",
                "width"=>"10",
                "height"=>"5"
            ),
            array(
                "name"=>"3.Inprogress : \n[".(string)($countverarr[2]+$countverarr[3]+$countverarr[4]+$countverarr[5]+$countverarr[6])."]",
                "leftArray"=>[],
                "rightArray"=>[],
                "topArray"=>[],
                "bottomArray"=>[],
                "key"=>-12,
                "loc"=>"310 250",
                "color"=> "#2F5596",
                "width"=>"10",
                "height"=>"5"
            ),
            array(
                "name"=>"11.Pending BASO : \n[".(string)($countverarr[7]+$countverarr[8])."]",
                "leftArray"=>[],
                "rightArray"=>[
                    array(
                        "portId"=>"right0",
                        "portColor"=>"#000"
                    ),
                ],
                "topArray"=>[],
                "bottomArray"=>[],
                "key"=>-13,
                "loc"=>"310 310",
                "color"=> "#2F5596",
                "width"=>"10",
                "height"=>"5"
            ),
            array(
                "name"=>"13.Pending Billing\nApproval : [".(string)($countverarr[9]+$countverarr[10])."]",
                "leftArray"=>[],
                "rightArray"=>[
                    array(
                        "portId"=>"right0",
                        "portColor"=>"#000"
                    ),
                ],
                "topArray"=>[],
                "bottomArray"=>[],
                "key"=>-14,
                "loc"=>"310 370",
                "color"=> "#2F5596",
                "width"=>"10",
                "height"=>"5"
            ),
            array(
                "name"=>"AIA\nCOM",
                "leftArray"=> [
                    array("portId"=>"left0", "portColor"=>"#000"),
                    array("portId"=>"left1", "portColor"=>"#000"),
                    array("portId"=>"left2", "portColor"=>"#000"),
                    array("portId"=>"left3", "portColor"=>"#000"),
                    array("portId"=>"left4", "portColor"=>"#000"),
                    array("portId"=>"left5", "portColor"=>"#000"),
                ],
                "rightArray"=>[
                    array("portId"=>"right0", "portColor"=>"#000"),
                    array("portId"=>"right1", "portColor"=>"#000"),
                    array("portId"=>"right2", "portColor"=>"#000"),
                    array("portId"=>"right3", "portColor"=>"#000"),
                    array("portId"=>"right4", "portColor"=>"#000"),
                    array("portId"=>"right5", "portColor"=>"#000"),
                ],
                "topArray"=>[
                    array("portId"=>"top0", "portColor"=>"#000"),
                    array("portId"=>"top1", "portColor"=>"#000"),
                    array("portId"=>"top2", "portColor"=>"#000"),
                    array("portId"=>"top3", "portColor"=>"#000"),
                    array("portId"=>"top4", "portColor"=>"#000"),
                    array("portId"=>"top5", "portColor"=>"#000"),
                ],
                "bottomArray"=>[
                    array("portId"=>"bottom0", "portColor"=>"#000"),
                    array("portId"=>"bottom1", "portColor"=>"#000"),
                    array("portId"=>"bottom2", "portColor"=>"#000"),
                    array("portId"=>"bottom3", "portColor"=>"#000"),
                    array("portId"=>"bottom4", "portColor"=>"#000"),
                    array("portId"=>"bottom5", "portColor"=>"#000"),
                ],
                "key"=>-15,
                "loc"=>"460 157",
                "color"=> "green",
                "width"=>"10",
                "height"=>"10"
            ),
            array(
                "name"=>"X.Failed",
                "leftArray"=>[
                    array("portId"=>"left0", "portColor"=>"#000"),
                ],
                "rightArray"=>[],
                "topArray"=>[],
                "bottomArray"=>[],
                "key"=>-16,
                "loc"=>"255 560",
                "color"=> "#000",
                "width"=>"20",
                "height"=>"5"
            ),
            array(
                "name"=>"TSQ\n[?]",
                "leftArray"=>[],
                "rightArray"=>[],
                "topArray"=>[
                    array("portId"=>"top0", "portColor"=>"#000"),
                ],
                "bottomArray"=>[],
                "key"=>-17,
                "loc"=>"460 500",
                "color"=> "red",
                "width"=>"5",
                "height"=>"5"
            ),
            array(
                "name"=>"Deliver\n[?]",
                "leftArray"=>[],
                "rightArray"=>[],
                "topArray"=>[
                    array("portId"=>"top0", "portColor"=>"#000"),
                ],
                "bottomArray"=>[],
                "key"=>-18,
                "loc"=>"520 500",
                "color"=> "red",
                "width"=>"5",
                "height"=>"5"),
            array(
                "name"=>"TREMS",
                "leftArray"=>[
                    array("portId"=>"left0", "portColor"=>"#000"),
                ],
                "rightArray"=>[],
                "topArray"=>[],
                "bottomArray"=>[],
                "key"=>-20,
                "loc"=>"450 -60",
                "color"=> "#ED7D31",
                "width"=>"10",
                "height"=>"5"
            ),
            array(
                "name"=>"TIBS",
                "leftArray"=>[],
                "rightArray"=>[
                    array("portId"=>"right0", "portColor"=>"#000"),
                ],
                "topArray"=>[],
                "bottomArray"=>[
                    array("portId"=>"bottom0", "portColor"=>"#000"),
                    array("portId"=>"bottom1", "portColor"=>"#000"),
                ],
                "key"=>-21,
                "loc"=>"450 0 ",
                "color"=> "#ED7D31",
                "width"=>"10",
                "height"=>"5"
            ),
            array(
                "name"=>"3.SCS : [".(string)$countverarr[3]."]",
                "leftArray"=>[],
                "rightArray"=>[],
                "topArray"=>[
                    array("portId"=>"top0", "portColor"=>"#000"),
                ],
                "bottomArray"=>[],
                "key"=>-22,
                "loc"=>"550 250",
                "color"=> "#B3C7E8",
                "width"=>"5", "height"=>"5"
            ),
            array(
                "name"=>"5.SCC : [".(string)$countverarr[4]."]",
                "leftArray"=>[],
                "rightArray"=>[],
                "topArray"=>[
                    array("portId"=>"top0", "portColor"=>"#000"),
                ],
                "bottomArray"=>[],
                "key"=>-23,
                "loc"=>"610 250",
                "color"=> "#B3C7E8",
                "width"=>"5",
                "height"=>"5"
            ),
            array(
                "name"=>"8.PS : [".(string)$countverarr[5]."]",
                "leftArray"=>[],
                "rightArray"=>[],
                "topArray"=>[
                    array("portId"=>"top0", "portColor"=>"#000"),
                ],
                "bottomArray"=>[],
                "key"=>-24,
                "loc"=>"670 250",
                "color"=> "#B3C7E8",
                "width"=>"5",
                "height"=>"5"
            ),
            array(
                "name"=>"10.PC : [".(string)$countverarr[7]."]",
                "leftArray"=>[],
                "rightArray"=>[],
                "topArray"=>[
                    array("portId"=>"top0", "portColor"=>"#000"),
                ],
                "bottomArray"=>[],
                "key"=>-25,
                "loc"=>"730 250",
                "color"=> "#B3C7E8",
                "width"=>"5",
                "height"=>"5"
            ),
            array(
                "name"=>"12.BAS : [".(string)$countverarr[9]."]",
                "leftArray"=>[],
                "rightArray"=>[],
                "topArray"=>[
                    array("portId"=>"top0", "portColor"=>"#000"),
                ],
                "bottomArray"=>[
                    array("portId"=>"bottom0", "portColor"=>"#000"),
                ],
                "key"=>-27,
                "loc"=>"850 260",
                "color"=> "#B3C7E8",
                "width"=>"5",
                "height"=>"8"
            ),
            array(
                "name"=>"15.FBS : [".(string)$countverarr[10]."]",
                "leftArray"=>[],
                "rightArray"=>[],
                "topArray"=>[
                    array("portId"=>"top0", "portColor"=>"#000"),
                ],
                "bottomArray"=>[],
                "key"=>-28,
                "loc"=>"910 260",
                "color"=> "#B3C7E8",
                "width"=>"5",
                "height"=>"8"
            ),
            array(
                "name"=>"17.FBC : [".(string)$countverarr[12]."]",
                "leftArray"=>[],
                "rightArray"=>[],
                "topArray"=>[
                    array("portId"=>"top0", "portColor"=>"#000"),
                ],
                "bottomArray"=>[],
                "key"=>-29,
                "loc"=>"970 260",
                "color"=> "#B3C7E8",
                "width"=>"5",
                "height"=>"8"
            ),
            array(
                "name"=>"11.BS \n: [".(string)$countverarr[8]."]",
                "leftArray"=>[],
                "rightArray"=>[],
                "topArray"=>[
                    array("portId"=>"top0", "portColor"=>"#000"),
                ],
                "bottomArray"=>[
                    array("portId"=>"bottom0", "portColor"=>"#000"),
                ],
                "key"=>-30,
                "loc"=>"790 250",
                "color"=> "#B3C7E8",
                "width"=>"5",
                "height"=>"5"
            ),
            array(
                "name"=>"Dictionary:\n
                SCS: Sync Customer Start\n
                SCC: Sync Customer Complete\n
                PS: Provision Start\n
                PC: Provision Complete\n
                BS: BASO Started\n
                BAS: Billing Approval Start\n
                FBS: Fulfill Billing Start\n
                FBC: Fulfill Billing Complete\n
                MS: Milestone
                ",
                "leftArray"=>[],
                "rightArray"=>[],
                "topArray"=>[],
                "bottomArray"=>[],
                "key"=>41,
                "loc"=>"800 460",
                "color"=> "#95a5a6",
                "width"=>"23",
                "height"=>"23"
            ),
        );
        $data->linkDataArray            = array(
            array(
                "from"=>-3,
                "to"=>-4,
                "fromPort"=>"left0",
                "toPort"=>"left0",
                "points"=> [161.29644687500004,-52.437872812499876,151.29644687500004,-52.437872812499876,151.29644687500004,16.767127187500193,161.73642734375002,16.767127187500193,172.1764078125,16.767127187500193,186.1764078125,16.767127187500193],
                "text"=>"1"
            ),
            array(
                "from"=>-6,
                "to"=>-15,
                "fromPort"=>"bottom0",
                "toPort"=>"left0",
                "points"=>[360.3814078125,58.5761408593751,360.3814078125,68.5761408593751,360.3814078125,77.62036148697885,469.7483154787101,77.62036148697885,579.1152231449202,77.62036148697885,593.1152231449202,77.62036148697885],
                "text"=>"2"
            ),
            array(
                "from"=>-4,
                "to"=>-15,
                "fromPort"=>"bottom0",
                "toPort"=>"left1",
                "points"=>[222.1764078125,52.76712718750019,222.1764078125,62.76712718750019,222.1764078125,87.62036148697885,396.64581547871006,87.62036148697885,571.1152231449202,87.62036148697885,593.1152231449202,87.62036148697885],
                "text"=>"2"),
            array(
                "from"=>-15,
                "to"=>-16,
                "fromPort"=>"left2",
                "toPort"=>"left0",
                "points"=>[593.1152231449202,97.62036148697885,559.1152231449202,97.62036148697885,119.97046687500006,97.62036148697885,119.97046687500006,606.3750000000002,139.34318359375,606.3750000000002,153.34318359375,606.3750000000002]
            ),
            array(
                "from"=>-15,
                "to"=>-9,
                "fromPort"=>"left3",
                "toPort"=>"left0",
                "points"=>[593.1152231449202,107.62036148697885,567.1152231449202,107.62036148697885,137.41536864440107,107.62036148697885,137.41536864440107,321.68902618337614,137.41536864440107,535.7576908797735,151.41536864440107,535.7576908797735]
            ),
            array(
                "from"=>-15,
                "to"=>-7,
                "fromPort"=>"left4",
                "toPort"=>"top0",
                "points"=>[593.1152231449202,117.62036148697885,575.1152231449202,117.62036148697885,224.27898192565104,117.62036148697885,224.27898192565104,150.25532989431366,224.27898192565104,182.89029830164844,224.27898192565104,192.89029830164844],
                "text"=>"3"
            ),
            array(
                "from"=>-15,
                "to"=>-13,
                "fromPort"=>"left5",
                "toPort"=>"right0",
                "points"=>[593.1152231449202,127.62036148697885,583.1152231449202,127.62036148697885,527.4971745580938,127.62036148697885,527.4971745580938,336.5990483122387,475.8791259712674,336.5990483122387,461.8791259712674,336.5990483122387],
                "text"=>"11"
            ),
            array(
                "from"=>-15,
                "to"=>-14,
                "fromPort"=>"bottom0",
                "toPort"=>"right0",
                "points"=>[606.1152231449202,140.62036148697885,606.1152231449202,154.62036148697885,606.1152231449202,408.5990483122387,530.9986394018438,408.5990483122387,455.8820556587674,408.5990483122387,441.8820556587674,408.5990483122387],
                "text"=>"13"
            ),
            array(
                "from"=>-15,
                "to"=>-10,
                "fromPort"=>"bottom1",
                "toPort"=>"right0",
                "points"=>[616.1152231449202,140.62036148697885,616.1152231449202,162.62036148697885,616.1152231449202,472.75769087977346,532.6839970665355,472.75769087977346,449.25277098815104,472.75769087977346,435.25277098815104,472.75769087977346],
                "text"=>"17"
            ),
            array(
                "from"=>-15,
                "to"=>-17,
                "fromPort"=>"bottom2",
                "toPort"=>"top0",
                "points"=>[626.1152231449202,140.62036148697885,626.1152231449202,174.62036148697885,626.1152231449202,343.52001277473954,626.6542471875001,343.52001277473954,626.6542471875001,492.41966406250026,626.6542471875001,506.41966406250026],
                "text"=>"5"
            ),
            array(
                "from"=>-15,
                "to"=>-18,
                "fromPort"=>"bottom3",
                "toPort"=>"top0",
                "points"=>[636.1152231449202,140.62036148697885,636.1152231449202,166.62036148697885,636.1152231449202,340.34858359505205,698.1260146875003,340.34858359505205,698.1260146875003,482.0768057031253,698.1260146875003,496.0768057031253],
                "text"=>"6"
            ),
            array(
                "from"=>-20,
                "to"=>-15,
                "fromPort"=>"left0",
                "toPort"=>"top0",
                "points"=>[589.8069079687502,-121.24674843750012,579.8069079687502,-121.24674843750012,579.8069079687502,-1.3131934752606327,606.1152231449202,-1.3131934752606327,606.1152231449202,50.62036148697885,606.1152231449202,64.62036148697885],
                "text"=>"3"
            ),
            array(
                "from"=>-15,
                "to"=>-21,
                "fromPort"=>"top1",
                "toPort"=>"bottom0",
                "points"=>[616.1152231449202,64.62036148697885,616.1152231449202,22.62036148697885,616.1152231449202,-1.301028162760609,625.4830918750004,-1.301028162760609,625.4830918750004,2.777582187499931,625.4830918750004,-11.222417812500069],
                "text"=>"3"
            ),
            array(
                "from"=>-15,
                "to"=>-21,
                "fromPort"=>"top2",
                "toPort"=>"bottom1",
                "points"=>[626.1152231449202,64.62036148697885,626.1152231449202,30.62036148697885,626.1152231449202,14.698971837239391,635.4830918750004,14.698971837239391,635.4830918750004,10.777582187499931,635.4830918750004,-11.222417812500069],
                "text"=>"15"
            ),
            array(
                "from"=>-21,
                "to"=>-15,
                "fromPort"=>"right0",
                "toPort"=>"top3",
                "points"=>[666.4830918750004,-47.22241781250007,676.4830918750004,-47.22241781250007,676.4830918750004,33.69897183723939,636.1152231449202,33.69897183723939,636.1152231449202,38.62036148697885,636.1152231449202,64.62036148697885],
                "text"=>"16. BillComp"
            ),
            array(
                "from"=>-15,
                "to"=>-29,
                "fromPort"=>"top4",
                "toPort"=>"top0",
                "points"=>[646.1152231449202,64.62036148697885,646.1152231449202,46.62036148697885,1481.5184462594839,46.62036148697885,1481.5184462594839,97.5951865661145,1481.5184462594839,148.57001164525016,1481.5184462594839,162.57001164525016],
                "text"=>"15"
            ),
            array(
                "from"=>-15,
                "to"=>-28,
                "fromPort"=>"top5",
                "toPort"=>"top0",
                "points"=>[656.1152231449202,64.62036148697885,656.1152231449202,54.62036148697885,1366.7201582770733,54.62036148697885,1366.7201582770733,101.5951865661145,1366.7201582770733,148.57001164525016,1366.7201582770733,162.57001164525016],
                "text"=>"17"
            ),
            array(
                "from"=>-15,
                "to"=>-27,
                "fromPort"=>"right0",
                "toPort"=>"top0",
                "points"=>[669.1152231449202,77.62036148697885,719.1152231449202,77.62036148697885,1251.921870294663,77.62036148697885,1251.921870294663,111.54385835013599,1251.921870294663,145.46735521329313,1251.921870294663,159.46735521329313],
                "text"=>"13"
            ),
            array(
                "from"=>-15,
                "to"=>-30,
                "fromPort"=>"right1",
                "toPort"=>"top0",
                "points"=>[669.1152231449202,87.62036148697885,711.1152231449202,87.62036148697885,1146.431551608124,87.62036148697885,1146.431551608124,115.76819424214673,1146.431551608124,143.91602699731462,1146.431551608124,157.91602699731462],
                "text"=>"11"
            ),
            array(
                "from"=>-15,
                "to"=>-25,
                "fromPort"=>"right2",
                "toPort"=>"top0",
                "points"=>[669.1152231449202,97.62036148697885,703.1152231449202,97.62036148697885,1035.0643471875007,97.62036148697885,1035.0643471875007,119.53129793098947,1035.0643471875007,141.44223437500008,1035.0643471875007,155.44223437500008],
                "text"=>"10"
            ),
            array(
                "from"=>-15,
                "to"=>-24,
                "fromPort"=>"right3",
                "toPort"=>"top0",
                "points"=>[669.1152231449202,107.62036148697885,695.1152231449202,107.62036148697885,938.0669484375006,107.62036148697885,938.0669484375006,123.8931571497395,938.0669484375006,140.16595281250014,938.0669484375006,154.16595281250014],
                "text"=>"8"
            ),
            array(
                "from"=>-15,
                "to"=>-23,
                "fromPort"=>"right4",
                "toPort"=>"top0",
                "points"=>[669.1152231449202,117.62036148697885,687.1152231449202,117.62036148697885,838.5169865625005,117.62036148697885,838.5169865625005,128.8931571497395,838.5169865625005,140.16595281250014,838.5169865625005,154.16595281250014],
                "text"=>"4"
            ),
            array(
                "from"=>-15,
                "to"=>-22,
                "fromPort"=>"right5",
                "toPort"=>"top0",
                "points"=>[669.1152231449202,127.62036148697885,679.1152231449202,127.62036148697885,736.4144615625005,127.62036148697885,736.4144615625005,132.61687558723946,736.4144615625005,137.61338968750007,736.4144615625005,151.61338968750007],
                "text"=>"3"
            ),
            array(
                "from"=>-30,
                "to"=>-15,
                "fromPort"=>"bottom0",
                "toPort"=>"bottom5",
                "points"=>[1146.431551608124,229.91602699731462,1146.431551608124,243.91602699731462,656.1152231449202,243.91602699731462,656.1152231449202,197.26819424214673,656.1152231449202,150.62036148697885,656.1152231449202,140.62036148697885],
                "text"=>"12. BASO Approved"
            ),
            array(
                "from"=>-27,
                "to"=>-15,
                "fromPort"=>"bottom0",
                "toPort"=>"bottom4",
                "points"=>[1251.921870294663,231.46735521329313,1251.921870294663,245.46735521329313,1251.921870294663,262.17446850036936,646.1152231449202,262.17446850036936,646.1152231449202,158.62036148697885,646.1152231449202,140.62036148697885],
                "text"=>"14. Billing Approved"
            )
        );
        return json_encode($data);
    }

    public function flowreport(){
        $lastupdate = DB::select('select lastupdate from int_report limit 1')[0];
        return view('report.flowreport',['lu'=>$lastupdate]);
    }

}
