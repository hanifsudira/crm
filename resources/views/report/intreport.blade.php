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
                                    <td>{{$data[$i]->tsq}}</td>
                                    <td>{{$data[$i]->del}}</td>
                                    <td>{{$data[$i]->pb}}</td>
                                    <td>{{$data[$i]->pba}}</td>
                                    <td>{{$data[$i]->non}}</td>
                                    <td>{{$data[$i]->et+$data[$i]->ed+$data[$i]->esc+$data[$i]->efbs+$data[$i]->tsq+$data[$i]->del+$data[$i]->pb+$data[$i]->pba+$data[$i]->non}}</td>
                                </tr>
                            @endfor
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
