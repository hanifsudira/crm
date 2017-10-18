@extends('dashboard.app')
@section('title', 'Review Transaksi')
@section('content')
    <section class="content-header">
        <h1>Review Transaksi</h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li>Report</li>
            <li class="active">Review Transaksi</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="box">
                <div class="box-body">
                    <div class="col-lg-12">
                        <div class="col-lg-2 col-md-6 col-sm-6">
                            <div class="card card-stats">
                                <div class="card-content">
                                    <p class="category"></p>
                                    <h2 class="title">Order Masuk</h2>
                                </div>
                            </div>
                        </div>
                        @foreach($data as $d)
                            <div class="col-lg-1 col-md-6 col-sm-6">
                                <div class="card card-stats">
                                    <div class="card-content">
                                        <p class="category">{{$d->newtanggal}}</p>
                                        <h1 class="title">{{$d->newcount}}</h1>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection