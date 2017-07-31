@extends('dashboard.app')
@section('title', 'Oracle Query Data')
@section('content')
    <section class="content-header">
        <h1>Siebel Query Data</h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li>Oracle</li>
            <li class="active">Data Table</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Data</h3>
                    </div>
                    <div class="box-body">
                        <table id="datatable" class="table table-bordered table-striped" style="overflow-x: scroll;">
                            <thead>
                            <tr>
                                <th>STATUS_ORDER</th>
                                <th>STATUS_FULFILLMENT</th>
                                <th>MILESTONE</th>
                                <th>JUMLAH</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($data as $d)
                                    <tr>
                                        <td>{{$d->STATUS_ORDER}}</td>
                                        <td>{{$d->STATUS_FULFILLMENT}}</td>
                                        <td>{{$d->MILESTONE}}</td>
                                        <td>{{$d->JUMLAH}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
