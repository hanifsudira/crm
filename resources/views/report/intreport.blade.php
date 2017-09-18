@extends('dashboard.app')
@section('title', 'Integrasi Report')
@section('content')
    <section class="content-header">
        <h1>All Report</h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li>Report</li>
            <li class="active">All Report</li>
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
                                <th>ESC</th>
                                <th>ET</th>
                                <th>ED</th>
                                <th>EFBS</th>
                                <th>None</th>
                                <th>TSQ</th>
                                <th>Deliver</th>
                                <th>PB</th>
                                <th>PBA</th>
                                <th>Complete</th>
                                <th>Total</th>
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
                                        <td align="right">{{$data[$i]->esc}}</td>
                                        <td align="right">{{$data[$i]->et}}</td>
                                        <td align="right">{{$data[$i]->ed}}</td>
                                        <td align="right">{{$data[$i]->efbs}}</td>
                                        <td align="right">{{$data[$i]->non}}</td>
                                        <td align="right">{{$data[$i]->tsq}}</td>
                                        <td align="right">{{$data[$i]->del}}</td>
                                        <td align="right">{{$data[$i]->com}}</td>
                                        <td align="right">{{$data[$i]->pb}}</td>
                                        <td align="right">{{$data[$i]->pba}}</td>
                                    @else
                                        <td align="right" class="danger">{{$data[$i]->esc}}</td>
                                        <td align="right" class="danger">{{$data[$i]->et}}</td>
                                        <td align="right" class="danger">{{$data[$i]->ed}}</td>
                                        <td align="right" class="danger">{{$data[$i]->efbs}}</td>
                                        <td align="right" class="danger">{{$data[$i]->non}}</td>
                                        @if($i==4)
                                            <td align="right" class="success">{{$data[$i]->tsq}}</td>
                                        @else
                                            <td align="right" class="warning">{{$data[$i]->tsq}}</td>
                                        @endif

                                        @if($i==5 or $i==6)
                                            <td align="right" class="success">{{$data[$i]->del}}</td>
                                        @else
                                            <td align="right" class="warning">{{$data[$i]->del}}</td>
                                        @endif

                                        @if($i==8 or $i==11)
                                            <td align="right" class="success">{{$data[$i]->pb}}</td>
                                        @else
                                            <td align="right" class="warning">{{$data[$i]->pb}}</td>
                                        @endif

                                        @if($i==9)
                                            <td align="right" class="success">{{$data[$i]->pba}}</td>
                                        @else
                                            <td align="right" class="warning">{{$data[$i]->pba}}</td>
                                        @endif

                                        @if($i==12)
                                            <td align="right" class="success">{{$data[$i]->com}}</td>
                                        @else
                                            <td align="right" class="warning">{{$data[$i]->com}}</td>
                                        @endif

                                    @endif
                                    <td align="right">{{number_format($data[$i]->et+$data[$i]->ed+$data[$i]->esc+$data[$i]->efbs+$data[$i]->tsq+$data[$i]->del+$data[$i]->pb+$data[$i]->pba+$data[$i]->non)}}</td>
                                </tr>
                            @endfor
                            <tr>
                                <td></td>
                                <td></td>
                                <td align="right">{{$hor[0]}}</td>
                                <td align="right">{{$hor[1]}}</td>
                                <td align="right">{{$hor[2]}}</td>
                                <td align="right">{{$hor[3]}}</td>
                                <td align="right">{{$hor[4]}}</td>
                                <td align="right">{{$hor[5]}}</td>
                                <td align="right">{{$hor[6]}}</td>
                                <td align="right">{{$hor[7]}}</td>
                                <td align="right">{{$hor[8]}}</td>
                                <td align="right">{{$hor[9]}}</td>
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
                                Complete : <strong>{{number_format($data[4]->tsq+$data[5]->del+$data[6]->del+$data[8]->pb+$data[11]->pb+$data[9]->pba+$data[12]->com)}}</strong>
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
