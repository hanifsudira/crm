@extends('dashboard.app')
@section('title', 'All Report')
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
                                <th>Error TSQ</th>
                                <th>Error Deliver</th>
                                <th>Error Sync C</th>
                                <th>Error Fulfill BS</th>
                                <th>TSQ</th>
                                <th>Deliver</th>
                                <th>Complete</th>
                                <th>Pending BASO</th>
                                <th>Pending Billing A</th>
                                <th>None</th>
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
                                    <td class="danger">{{$data[$i]->et}}</td>
                                    <td class="danger">{{$data[$i]->ed}}</td>
                                    <td class="danger">{{$data[$i]->esc}}</td>
                                    <td class="danger">{{$data[$i]->efbs}}</td>
                                    <td class="warning">{{$data[$i]->tsq}}</td>
                                    <td class="warning">{{$data[$i]->del}}</td>
                                    <td class="warning">{{$data[$i]->com}}</td>
                                    <td class="warning">{{$data[$i]->pb}}</td>
                                    <td class="warning">{{$data[$i]->pba}}</td>
                                    <td class="danger">{{$data[$i]->non}}</td>
                                    <td>{{$data[$i]->et+$data[$i]->ed+$data[$i]->esc+$data[$i]->efbs+$data[$i]->tsq+$data[$i]->del+$data[$i]->pb+$data[$i]->pba+$data[$i]->non}}</td>
                                </tr>
                            @endfor
                            <tr>
                                <td></td>
                                <td></td>
                                <td>{{$hor[0]}}</td>
                                <td>{{$hor[1]}}</td>
                                <td>{{$hor[2]}}</td>
                                <td>{{$hor[3]}}</td>
                                <td>{{$hor[4]}}</td>
                                <td>{{$hor[5]}}</td>
                                <td>{{$hor[6]}}</td>
                                <td>{{$hor[7]}}</td>
                                <td>{{$hor[8]}}</td>
                                <td>{{$hor[9]}}</td>
                                <td>{{$hor[0]+$hor[1]+$hor[2]+$hor[3]+$hor[4]+$hor[5]+$hor[6]+$hor[7]+$hor[8]+$hor[8]}}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection