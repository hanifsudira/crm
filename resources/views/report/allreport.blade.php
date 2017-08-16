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
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-body">
                        <table id="datatable" class="table table-bordered table-striped" style="overflow-x: scroll;">
                            <thead>
                                <tr>
                                    <th>Status</th>
                                    <th>Milestone</th>
                                    <th>DO</th>
                                    <th>MO</th>
                                    <th>AO</th>
                                    <th>RO</th>
                                    <th>SO</th>
                                    <th>DB CRM</th>
                                    <th>Integrasi</th>
                                    <th>DB/Total</th>
                                    <th>Int/Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @for($i=0;$i<21;$i++)
                                    <tr>
                                        <td>{{$status[$i]}}</td>
                                        <td>{{$milestone[$i]}}</td>
                                        @if($data[$i]!=null)
                                            <td>{{$data[$i]->do}}</td>
                                            <td>{{$data[$i]->mo}}</td>
                                            <td>{{$data[$i]->ao}}</td>
                                            <td>{{$data[$i]->ro}}</td>
                                            <td>{{$data[$i]->so}}</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        @else
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        @endif
                                    </tr>
                                @endfor
                                <tr>
                                    <td>Total</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection