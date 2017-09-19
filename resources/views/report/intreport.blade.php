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
                                <th colspan="2" style="text-align: center;">None</th>
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
                                        <td align="right"><a href="{{route('ora.getorderdetail',[$data[$i]->li_status,$data[$i]->milestone,"ERROR SYNC CUSTOMER","min",])}}" target="_blank">{{$datamin24[$i]->esc}}</a></td>
                                            <td align="right">{{$datamax24[$i]->esc}}</td>
                                        <td align="right">{{$datamin24[$i]->et}}</td>
                                            <td align="right">{{$datamax24[$i]->et}}</td>
                                        <td align="right">{{$datamin24[$i]->ed}}</td>
                                            <td align="right">{{$datamax24[$i]->ed}}</td>
                                        <td align="right">{{$datamin24[$i]->efbs}}</td>
                                            <td align="right">{{$datamax24[$i]->efbs}}</td>
                                        <td align="right">{{$datamin24[$i]->non}}</td>
                                            <td align="right">{{$datamax24[$i]->non}}</td>
                                        <td align="right">{{$datamin24[$i]->tsq}}</td>
                                            <td align="right">{{$datamax24[$i]->tsq}}</td>
                                        <td align="right">{{$datamin24[$i]->del}}</td>
                                            <td align="right">{{$datamax24[$i]->del}}</td>
                                        <td align="right">{{$datamin24[$i]->pb}}</td>
                                            <td align="right">{{$datamax24[$i]->pb}}</td>
                                        <td align="right">{{$datamin24[$i]->pba}}</td>
                                            <td align="right">{{$datamax24[$i]->pba}}</td>
                                        <td align="right">{{$datamin24[$i]->com}}</td>
                                            <td align="right">{{$datamax24[$i]->com}}</td>
                                    @else
                                        <td align="right" class="danger">{{$datamin24[$i]->esc}}</td>
                                            <td align="right" class="danger">{{$datamax24[$i]->esc}}</td>
                                        <td align="right" class="danger">{{$datamin24[$i]->et}}</td>
                                            <td align="right" class="danger">{{$datamax24[$i]->et}}</td>
                                        <td align="right" class="danger">{{$datamin24[$i]->ed}}</td>
                                            <td align="right" class="danger">{{$datamax24[$i]->ed}}</td>
                                        <td align="right" class="danger">{{$datamin24[$i]->efbs}}</td>
                                            <td align="right" class="danger">{{$datamax24[$i]->efbs}}</td>
                                        <td align="right" class="danger">{{$datamin24[$i]->non}}</td>
                                            <td align="right" class="danger">{{$datamax24[$i]->non}}</td>
                                        @if($i==4)
                                            <td align="right" class="success">{{$datamin24[$i]->tsq}}</td>
                                                <td align="right" class="success">{{$datamax24[$i]->tsq}}</td>
                                        @else
                                            <td align="right" class="warning">{{$datamin24[$i]->tsq}}</td>
                                                <td align="right" class="warning">{{$datamax24[$i]->tsq}}</td>
                                        @endif

                                        @if($i==5 or $i==6)
                                            <td align="right" class="success">{{$datamin24[$i]->del}}</td>
                                                <td align="right" class="success">{{$datamax24[$i]->del}}</td>
                                        @else
                                            <td align="right" class="warning">{{$datamin24[$i]->del}}</td>
                                                <td align="right" class="warning">{{$datamax24[$i]->del}}</td>
                                        @endif

                                        @if($i==8)
                                            <td align="right" class="success">{{$datamin24[$i]->pb}}</td>
                                                <td align="right" class="success">{{$datamax24[$i]->pb}}</td>
                                        @else
                                            <td align="right" class="warning">{{$datamin24[$i]->pb}}</td>
                                                <td align="right" class="warning">{{$datamax24[$i]->pb}}</td>
                                        @endif

                                        @if($i==9)
                                            <td align="right" class="success">{{$datamin24[$i]->pba}}</td>
                                                <td align="right" class="success">{{$datamax24[$i]->pba}}</td>
                                        @else
                                            <td align="right" class="warning">{{$datamin24[$i]->pba}}</td>
                                                <td align="right" class="warning">{{$datamax24[$i]->pba}}</td>
                                        @endif

                                        @if($i==11 or $i==12 )
                                            <td align="right" class="success">{{$datamin24[$i]->com}}</td>
                                                <td align="right" class="success">{{$datamax24[$i]->com}}</td>
                                        @else
                                            <td align="right" class="warning">{{$datamin24[$i]->com}}</td>
                                                <td align="right" class="warning">{{$datamax24[$i]->com}}</td>
                                        @endif

                                    @endif
                                    <td align="right">{{number_format($data[$i]->et+$data[$i]->ed+$data[$i]->esc+$data[$i]->efbs+$data[$i]->tsq+$data[$i]->del+$data[$i]->pb+$data[$i]->pba+$data[$i]->non)}}</td>
                                </tr>
                            @endfor
                            <tr>
                                <td></td>
                                <td></td>
                                <td colspan="2" align="right">{{$hor[0]}}</td>
                                <td colspan="2" align="right">{{$hor[1]}}</td>
                                <td colspan="2" align="right">{{$hor[2]}}</td>
                                <td colspan="2" align="right">{{$hor[3]}}</td>
                                <td colspan="2" align="right">{{$hor[4]}}</td>
                                <td colspan="2" align="right">{{$hor[5]}}</td>
                                <td colspan="2" align="right">{{$hor[6]}}</td>
                                <td colspan="2" align="right">{{$hor[7]}}</td>
                                <td colspan="2" align="right">{{$hor[8]}}</td>
                                <td colspan="2" align="right">{{$hor[9]}}</td>
                                <td align="right">{{number_format($hor[0]+$hor[1]+$hor[2]+$hor[3]+$hor[4]+$hor[5]+$hor[6]+$hor[7]+$hor[8]+$hor[9])}}</td>
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
                            <div>
                                ESC : <strong>Error Sync Customer</strong>
                            </div>
                            <div>
                                ET : <strong>Error TSQ</strong>
                            </div>
                            <div>
                                ED : <strong>Error Deliver</strong>
                            </div>
                            <div>
                                EFBS : <strong>Error Fullfill Billing Start</strong>
                            </div>
                            <div>
                                PB : <strong>Pending BASO</strong>
                            </div>
                            <div>
                                PBA : <strong>Pending Billing Approval</strong>
                            </div>
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
                                Complete : <strong>{{number_format($data[4]->tsq+$data[5]->del+$data[6]->del+$data[8]->pb+$data[9]->pba+$data[11]->com+$data[12]->com)}}</strong>
                            </div>
                            <div style="background-color : #FCF8E3;">
                                Status Tidak Terupdate :  <strong>{{number_format(($hor[5]+$hor[6]+$hor[7]+$hor[8]+$hor[9])-($data[4]->tsq+$data[5]->del+$data[6]->del+$data[8]->pb+$data[11]->pb+$data[9]->pba+$data[12]->com))}}</strong>
                            </div>
                            <div style="background-color : #F2DEDE;">
                                Error :  <strong>{{number_format($hor[0]+$hor[1]+$hor[2]+$hor[3]+$hor[4])}}</strong>
                            </div>
                        </fieldset>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
