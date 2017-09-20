@extends('dashboard.app')
@section('title', 'Integrasi Report')
@section('content')
    <section class="content-header">
        <h1>All Report</h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li>Report</li>
            <li class="active">Integration Report</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box-header">
                    <h1 class="box-title">Last Update : <a>{{$lu}}</a></h1>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-body">
                        <table id="datatable" class="table table-bordered table-striped" style="overflow-x: scroll;">
                            <thead>
                            <tr>
                                <th>Status</th>
                                <th>Milestone</th>
                                <th colspan="2" style="text-align: center;">ESC</th>
                                <th colspan="2" style="text-align: center;">ET</th>
                                <th colspan="2" style="text-align: center;">ED</th>
                                <th colspan="2" style="text-align: center;">EFBS</th>
                                <th colspan="2" style="text-align: center;">ND</th>
                                <th colspan="2" style="text-align: center;">None</th>
                                <th colspan="2" style="text-align: center;">CFO</th>
                                <th colspan="2" style="text-align: center;">EA</th>
                                <th colspan="2" style="text-align: center;">TSQ</th>
                                <th colspan="2" style="text-align: center;">Deliver</th>
                                <th colspan="2" style="text-align: center;">PB</th>
                                <th colspan="2" style="text-align: center;">PBA</th>
                                <th colspan="2" style="text-align: center;">Complete</th>
                                <th>Total</th>
                            </tr>
                            </thead>
                            <tr>
                                <th></th>
                                <th></th>
                                <th>24</th>
                                <th>&gt;</th>
                                <th>24</th>
                                <th>&gt;</th>
                                <th>24</th>
                                <th>&gt;</th>
                                <th>24</th>
                                <th>&gt;</th>
                                <th>24</th>
                                <th>&gt;</th>
                                <th>24</th>
                                <th>&gt;</th>
                                <th>24</th>
                                <th>&gt;</th>
                                <th>24</th>
                                <th>&gt;</th>
                                <th>24</th>
                                <th>&gt;</th>
                                <th>24</th>
                                <th>&gt;</th>
                                <th>24</th>
                                <th>&gt;</th>
                                <th>24</th>
                                <th>&gt;</th>
                                <th>24</th>
                                <th>&gt;</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @for($i=0;$i<count($data);$i++)
                                <tr>
                                    @if($i-1>-1 and $data[$i]->li_status==$data[$i-1]->li_status)
                                        <td></td>
                                    @else($i)
                                        <td>{{$data[$i]->li_status}}</td>
                                    @endif
                                    <td>{{$data[$i]->milestone}}</td>
                                    @if($i==0)
                                        <td align="right"><a href="{{route('ora.getorderdetail',[$data[$i]->li_status,$data[$i]->milestone,"ERROR SYNC CUSTOMER","min"])}}" target="_blank">{{$datamin24[$i]->esc}}</a></td>
                                        <td align="right"><a href="{{route('ora.getorderdetail',[$data[$i]->li_status,$data[$i]->milestone,"ERROR SYNC CUSTOMER","max"])}}" target="_blank">{{$datamax24[$i]->esc}}</a></td>
                                        <td align="right"><a href="{{route('ora.getorderdetail',[$data[$i]->li_status,$data[$i]->milestone,"ERROR TSQ","min"])}}" target="_blank">{{$datamin24[$i]->et}}</a></td>
                                        <td align="right"><a href="{{route('ora.getorderdetail',[$data[$i]->li_status,$data[$i]->milestone,"ERROR TSQ","max"])}}" target="_blank">{{$datamax24[$i]->et}}</a></td>
                                        <td align="right"><a href="{{route('ora.getorderdetail',[$data[$i]->li_status,$data[$i]->milestone,"ERROR DELIVER","min"])}}" target="_blank">{{$datamin24[$i]->ed}}</a></td>
                                        <td align="right"><a href="{{route('ora.getorderdetail',[$data[$i]->li_status,$data[$i]->milestone,"ERROR DELIVER","max"])}}" target="_blank">{{$datamax24[$i]->ed}}</a></td>
                                        <td align="right"><a href="{{route('ora.getorderdetail',[$data[$i]->li_status,$data[$i]->milestone,"ERROR FULFILL BILLING START","min"])}}" target="_blank">{{$datamin24[$i]->efbs}}</a></td>
                                        <td align="right"><a href="{{route('ora.getorderdetail',[$data[$i]->li_status,$data[$i]->milestone,"ERROR FULFILL BILLING START","max"])}}" target="_blank">{{$datamax24[$i]->efbs}}</a></td>
                                        <td align="right"><a href="{{route('ora.getorderdetail',[$data[$i]->li_status,$data[$i]->milestone,"NEED DELIVER","min"])}}" target="_blank">{{$datamin24[$i]->nd}}</a></td>
                                        <td align="right"><a href="{{route('ora.getorderdetail',[$data[$i]->li_status,$data[$i]->milestone,"NEED DELIVER","max"])}}" target="_blank">{{$datamax24[$i]->nd}}</a></td>
                                        <td align="right"><a href="{{route('ora.getorderdetail',[$data[$i]->li_status,$data[$i]->milestone,"None","min"])}}" target="_blank">{{$datamin24[$i]->non}}</a></td>
                                        <td align="right"><a href="{{route('ora.getorderdetail',[$data[$i]->li_status,$data[$i]->milestone,"None","max"])}}" target="_blank">{{$datamax24[$i]->non}}</a></td>

                                        <td align="right"><a href="{{route('ora.getorderdetail',[$data[$i]->li_status,$data[$i]->milestone,"CANCEL FROM OSS","min"])}}" target="_blank">{{$datamin24[$i]->cfo}}</a></td>
                                        <td align="right"><a href="{{route('ora.getorderdetail',[$data[$i]->li_status,$data[$i]->milestone,"CANCEL FROM OSS","max"])}}" target="_blank">{{$datamax24[$i]->cfo}}</a></td>
                                        <td align="right"><a href="{{route('ora.getorderdetail',[$data[$i]->li_status,$data[$i]->milestone,"ERROR AREA","min"])}}" target="_blank">{{$datamin24[$i]->ea}}</a></td>
                                        <td align="right"><a href="{{route('ora.getorderdetail',[$data[$i]->li_status,$data[$i]->milestone,"ERROR AREA","max"])}}" target="_blank">{{$datamax24[$i]->ea}}</a></td>

                                        <td align="right"><a href="{{route('ora.getorderdetail',[$data[$i]->li_status,$data[$i]->milestone,"TSQ","min"])}}" target="_blank">{{$datamin24[$i]->tsq}}</a></td>
                                        <td align="right"><a href="{{route('ora.getorderdetail',[$data[$i]->li_status,$data[$i]->milestone,"TSQ","max"])}}" target="_blank">{{$datamax24[$i]->tsq}}</a></td>
                                        <td align="right"><a href="{{route('ora.getorderdetail',[$data[$i]->li_status,$data[$i]->milestone,"DELIVER","min"])}}" target="_blank">{{$datamin24[$i]->del}}</a></td>
                                        <td align="right"><a href="{{route('ora.getorderdetail',[$data[$i]->li_status,$data[$i]->milestone,"DELIVER","max"])}}" target="_blank">{{$datamax24[$i]->del}}</a></td>
                                        <td align="right"><a href="{{route('ora.getorderdetail',[$data[$i]->li_status,$data[$i]->milestone,"PENDING BASO","min"])}}" target="_blank">{{$datamin24[$i]->pb}}</a></td>
                                        <td align="right"><a href="{{route('ora.getorderdetail',[$data[$i]->li_status,$data[$i]->milestone,"PENDING BASO","max"])}}" target="_blank">{{$datamax24[$i]->pb}}</a></td>
                                        <td align="right"><a href="{{route('ora.getorderdetail',[$data[$i]->li_status,$data[$i]->milestone,"PENDING BILLING APPROVAL","min"])}}" target="_blank">{{$datamin24[$i]->pba}}</a></td>
                                        <td align="right"><a href="{{route('ora.getorderdetail',[$data[$i]->li_status,$data[$i]->milestone,"PENDING BILLING APPROVAL","max"])}}" target="_blank">{{$datamax24[$i]->pba}}</a></td>
                                        <td align="right"><a href="{{route('ora.getorderdetail',[$data[$i]->li_status,$data[$i]->milestone,"COMPLETE","min"])}}" target="_blank">{{$datamin24[$i]->com}}</a></td>
                                        <td align="right"><a href="{{route('ora.getorderdetail',[$data[$i]->li_status,$data[$i]->milestone,"COMPLETE","max"])}}" target="_blank">{{$datamax24[$i]->com}}</a></td>
                                    @else
                                        <td align="right" class="danger"><a href="{{route('ora.getorderdetail',[$data[$i]->li_status,$data[$i]->milestone,"ERROR SYNC CUSTOMER","min"])}}" target="_blank">{{$datamin24[$i]->esc}}</a></td>
                                        <td align="right" class="danger"><a href="{{route('ora.getorderdetail',[$data[$i]->li_status,$data[$i]->milestone,"ERROR SYNC CUSTOMER","max"])}}" target="_blank">{{$datamax24[$i]->esc}}</a></td>
                                        <td align="right" class="danger"><a href="{{route('ora.getorderdetail',[$data[$i]->li_status,$data[$i]->milestone,"ERROR TSQ","min"])}}" target="_blank">{{$datamin24[$i]->et}}</a></td>
                                        <td align="right" class="danger"><a href="{{route('ora.getorderdetail',[$data[$i]->li_status,$data[$i]->milestone,"ERROR TSQ","max"])}}" target="_blank">{{$datamax24[$i]->et}}</a></td>
                                        <td align="right" class="danger"><a href="{{route('ora.getorderdetail',[$data[$i]->li_status,$data[$i]->milestone,"ERROR DELIVER","min"])}}" target="_blank">{{$datamin24[$i]->ed}}</a></td>
                                        <td align="right" class="danger"><a href="{{route('ora.getorderdetail',[$data[$i]->li_status,$data[$i]->milestone,"ERROR DELIVER","max"])}}" target="_blank">{{$datamax24[$i]->ed}}</a></td>
                                        <td align="right" class="danger"><a href="{{route('ora.getorderdetail',[$data[$i]->li_status,$data[$i]->milestone,"ERROR FULFILL BILLING START","min"])}}" target="_blank">{{$datamin24[$i]->efbs}}</a></td>
                                        <td align="right" class="danger"><a href="{{route('ora.getorderdetail',[$data[$i]->li_status,$data[$i]->milestone,"ERROR FULFILL BILLING START","max"])}}" target="_blank">{{$datamax24[$i]->efbs}}</a></td>
                                        <td align="right" class="danger"><a href="{{route('ora.getorderdetail',[$data[$i]->li_status,$data[$i]->milestone,"NEED DELIVER","min"])}}" target="_blank">{{$datamin24[$i]->nd}}</a></td>
                                        <td align="right" class="danger"><a href="{{route('ora.getorderdetail',[$data[$i]->li_status,$data[$i]->milestone,"NEED DELIVER","max"])}}" target="_blank">{{$datamax24[$i]->nd}}</a></td>
                                        <td align="right" bgcolor="#e74c3c"><a href="{{route('ora.getorderdetail',[$data[$i]->li_status,$data[$i]->milestone,"None","min"])}}" target="_blank">{{$datamin24[$i]->non}}</a></td>
                                        <td align="right" bgcolor="#e74c3c"><a href="{{route('ora.getorderdetail',[$data[$i]->li_status,$data[$i]->milestone,"None","max"])}}" target="_blank">{{$datamax24[$i]->non}}</a></td>

                                        <td align="right" class="info"><a href="{{route('ora.getorderdetail',[$data[$i]->li_status,$data[$i]->milestone,"CANCEL FROM OSS","min"])}}" target="_blank">{{$datamin24[$i]->cfo}}</a></td>
                                        <td align="right" class="info"><a href="{{route('ora.getorderdetail',[$data[$i]->li_status,$data[$i]->milestone,"CANCEL FROM OSS","max"])}}" target="_blank">{{$datamax24[$i]->cfo}}</a></td>
                                        <td align="right" class="info"><a href="{{route('ora.getorderdetail',[$data[$i]->li_status,$data[$i]->milestone,"ERROR AREA","min"])}}" target="_blank">{{$datamin24[$i]->ea}}</a></td>
                                        <td align="right" class="info"><a href="{{route('ora.getorderdetail',[$data[$i]->li_status,$data[$i]->milestone,"ERROR AREA","max"])}}" target="_blank">{{$datamax24[$i]->ea}}</a></td>

                                        @if($i==4)
                                            <td align="right" class="success"><a href="{{route('ora.getorderdetail',[$data[$i]->li_status,$data[$i]->milestone,"TSQ","min"])}}" target="_blank">{{$datamin24[$i]->tsq}}</a></td>
                                            <td align="right" class="success"><a href="{{route('ora.getorderdetail',[$data[$i]->li_status,$data[$i]->milestone,"TSQ","max"])}}" target="_blank">{{$datamax24[$i]->tsq}}</a></td>
                                        @else
                                            <td align="right" class="warning"><a href="{{route('ora.getorderdetail',[$data[$i]->li_status,$data[$i]->milestone,"TSQ","min"])}}" target="_blank">{{$datamin24[$i]->tsq}}</a></td>
                                            <td align="right" class="warning"><a href="{{route('ora.getorderdetail',[$data[$i]->li_status,$data[$i]->milestone,"TSQ","max"])}}" target="_blank">{{$datamax24[$i]->tsq}}</a></td>
                                        @endif

                                        @if($i==5 or $i==6)
                                            <td align="right" class="success"><a href="{{route('ora.getorderdetail',[$data[$i]->li_status,$data[$i]->milestone,"DELIVER","min"])}}" target="_blank">{{$datamin24[$i]->del}}</a></td>
                                            <td align="right" class="success"><a href="{{route('ora.getorderdetail',[$data[$i]->li_status,$data[$i]->milestone,"DELIVER","max"])}}" target="_blank">{{$datamax24[$i]->del}}</a></td>
                                        @else
                                            <td align="right" class="warning"><a href="{{route('ora.getorderdetail',[$data[$i]->li_status,$data[$i]->milestone,"DELIVER","min"])}}" target="_blank">{{$datamin24[$i]->del}}</a></td>
                                            <td align="right" class="warning"><a href="{{route('ora.getorderdetail',[$data[$i]->li_status,$data[$i]->milestone,"DELIVER","max"])}}" target="_blank">{{$datamax24[$i]->del}}</a></td>
                                        @endif

                                        @if($i==8 or $i==11)
                                            <td align="right" class="success"><a href="{{route('ora.getorderdetail',[$data[$i]->li_status,$data[$i]->milestone,"PENDING BASO","min"])}}" target="_blank">{{$datamin24[$i]->pb}}</a></td>
                                            <td align="right" class="success"><a href="{{route('ora.getorderdetail',[$data[$i]->li_status,$data[$i]->milestone,"PENDING BASO","max"])}}" target="_blank">{{$datamax24[$i]->pb}}</a></td>
                                        @else
                                            <td align="right" class="warning"><a href="{{route('ora.getorderdetail',[$data[$i]->li_status,$data[$i]->milestone,"PENDING BASO","min"])}}" target="_blank">{{$datamin24[$i]->pb}}</a></td>
                                            <td align="right" class="warning"><a href="{{route('ora.getorderdetail',[$data[$i]->li_status,$data[$i]->milestone,"PENDING BASO","max"])}}" target="_blank">{{$datamax24[$i]->pb}}</a></td>
                                        @endif

                                        @if($i==9)
                                                <td align="right" class="success"><a href="{{route('ora.getorderdetail',[$data[$i]->li_status,$data[$i]->milestone,"PENDING BILLING APPROVAL","min"])}}" target="_blank">{{$datamin24[$i]->pba}}</a></td>
                                                <td align="right" class="success"><a href="{{route('ora.getorderdetail',[$data[$i]->li_status,$data[$i]->milestone,"PENDING BILLING APPROVAL","max"])}}" target="_blank">{{$datamax24[$i]->pba}}</a></td>
                                        @else
                                                <td align="right" class="warning"><a href="{{route('ora.getorderdetail',[$data[$i]->li_status,$data[$i]->milestone,"PENDING BILLING APPROVAL","min"])}}" target="_blank">{{$datamin24[$i]->pba}}</a></td>
                                                <td align="right" class="warning"><a href="{{route('ora.getorderdetail',[$data[$i]->li_status,$data[$i]->milestone,"PENDING BILLING APPROVAL","max"])}}" target="_blank">{{$datamax24[$i]->pba}}</a></td>
                                        @endif

                                        @if($i==8)
                                                <td align="right" class="success"><a href="{{route('ora.getorderdetail',[$data[$i]->li_status,$data[$i]->milestone,"COMPLETE","min"])}}" target="_blank">{{$datamin24[$i]->com}}</a></td>
                                                <td align="right" class="success"><a href="{{route('ora.getorderdetail',[$data[$i]->li_status,$data[$i]->milestone,"COMPLETE","max"])}}" target="_blank">{{$datamax24[$i]->com}}</a></td>
                                        @else
                                                <td align="right" class="warning"><a href="{{route('ora.getorderdetail',[$data[$i]->li_status,$data[$i]->milestone,"COMPLETE","min"])}}" target="_blank">{{$datamin24[$i]->com}}</a></td>
                                                <td align="right" class="warning"><a href="{{route('ora.getorderdetail',[$data[$i]->li_status,$data[$i]->milestone,"COMPLETE","max"])}}" target="_blank">{{$datamax24[$i]->com}}</a></td>
                                        @endif

                                        @if($i==11 or $i==12 )
                                            <td align="right" bgcolor="black"><a href="{{route('ora.getorderdetail',[$data[$i]->li_status,$data[$i]->milestone,"COMPLETE","min"])}}" target="_blank">{{$datamin24[$i]->com}}</a></td>
                                            <td align="right" bgcolor="black"><a href="{{route('ora.getorderdetail',[$data[$i]->li_status,$data[$i]->milestone,"COMPLETE","max"])}}" target="_blank">{{$datamax24[$i]->com}}</a></td>
                                        @else
                                            <td align="right" bgcolor="black"><a href="{{route('ora.getorderdetail',[$data[$i]->li_status,$data[$i]->milestone,"COMPLETE","min"])}}" target="_blank">{{$datamin24[$i]->com}}</a></td>
                                            <td align="right" bgcolor="black"><a href="{{route('ora.getorderdetail',[$data[$i]->li_status,$data[$i]->milestone,"COMPLETE","max"])}}" target="_blank">{{$datamax24[$i]->com}}</a></td>
                                        @endif

                                    @endif
                                    <td align="right">{{number_format($data[$i]->esc+$data[$i]->et+$data[$i]->ed+$data[$i]->efbs+$data[$i]->nd+$data[$i]->non+$data[$i]->cfo+$data[$i]->ea+$data[$i]->tsq+$data[$i]->del+$data[$i]->pb+$data[$i]->pba+$data[$i]->com)}}</td>
                                </tr>
                            @endfor
                            <tr>
                                <td></td>
                                <td></td>
                                <td colspan="2" align="right">{{number_format($hor[0])}}</td>
                                <td colspan="2" align="right">{{number_format($hor[1])}}</td>
                                <td colspan="2" align="right">{{number_format($hor[2])}}</td>
                                <td colspan="2" align="right">{{number_format($hor[3])}}</td>
                                <td colspan="2" align="right">{{number_format($hor[12])}}</td>
                                <td colspan="2" align="right">{{number_format($hor[4])}}</td>
                                <td colspan="2" align="right">{{number_format($hor[10])}}</td>
                                <td colspan="2" align="right">{{number_format($hor[11])}}</td>
                                <td colspan="2" align="right">{{number_format($hor[5])}}</td>
                                <td colspan="2" align="right">{{number_format($hor[6])}}</td>
                                <td colspan="2" align="right">{{number_format($hor[7])}}</td>
                                <td colspan="2" align="right">{{number_format($hor[8])}}</td>
                                <td colspan="2" align="right">{{number_format($hor[9])}}</td>
                                <td align="right">{{number_format($hor[0]+$hor[1]+$hor[2]+$hor[3]+$hor[4]+$hor[5]+$hor[6]+$hor[7]+$hor[8]+$hor[9]+$hor[10]+$hor[11])}}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-6">
                <div class="box">
                    <div class="box-body">
                        <fieldset>
                            <legend>Dictionary : </legend>
                            <div>ESC : <strong>Error Sync Customer</strong></div>
                            <div>ET : <strong>Error TSQ</strong></div>
                            <div>ED : <strong>Error Deliver</strong></div>
                            <div>EFBS : <strong>Error Fulfill Billing Start</strong></div>
                            <div>PB : <strong>Pending BASO</strong></div>
                            <div>PBA : <strong>Pending Billing Approval</strong></div>
                            <div>CFO : <strong>Cancel From OSS</strong></div>
                            <div>EA : <strong>Error Area</strong></div>
                            <div>ND : <strong>Need Deliver</strong></div>
                        </fieldset>
                    </div>
                </div>
            </div>
            <div class="col-xs-6">
                <div class="box">
                    <div class="box-body">
                        <fieldset>
                            <legend>Legend : </legend>
                            <div style="background-color : #DFF0D8; ">
                                Complete : <strong>{{number_format($data[4]->tsq+$data[5]->del+$data[6]->del+$data[8]->pb+$data[11]->pb+$data[9]->pba+$data[8]->com+$data[11]->com+$data[12]->com)}}</strong>
                            </div>
                            <div style="background-color : #FCF8E3;">
                                Status Tidak Terupdate :  <strong>{{number_format(($hor[5]+$hor[6]+$hor[7]+$hor[8]+$hor[9])-($data[4]->tsq+$data[5]->del+$data[6]->del+$data[8]->pb+$data[11]->pb+$data[9]->pba+$data[8]->com+$data[11]->com+$data[12]->com) - ($data[0]->tsq+$data[0]->del+$data[0]->pb+$data[0]->pba+$data[0]->com))}}</strong>
                            </div>
                            <div style="background-color : #D9EDF7;">
                                Need User Action :  <strong>{{number_format(($hor[10]+$hor[11]) - ($data[0]->cfo+$data[0]->ea))}}</strong>
                            </div>
                            <div style="background-color : #F2DEDE;">
                                Error :  <strong>{{number_format(($hor[0]+$hor[1]+$hor[2]+$hor[3]+$hor[4]+$hor[12]) - ($data[0]->esc+$data[0]->et+$data[0]->ed+$data[0]->efbs+$data[0]->non))}}</strong>
                            </div>
                        </fieldset>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('css')
    <style>
        a:link { color:black; }
        a:visited { color:black; }
    </style>
@endsection
