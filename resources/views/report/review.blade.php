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
                                    <h1 class="title">LEAD</h1>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <div class="card card-stats">
                                <div class="card-content">
                                    <p class="category">UnQualified</p>
                                    <h1 class="title">{{$lead[0][1]}}</h1>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-6 col-sm-6">
                            <div class="card card-stats">
                                <div class="card-content">
                                    <p class="category">Qualified</p>
                                    <h1 class="title">{{$lead[1][1]}}</h1>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-6 col-sm-6">
                            <div class="card card-stats">
                                <div class="card-content">
                                    <p class="category">Converted</p>
                                    <h1 class="title">{{$lead[2][1]}}</h1>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-6 col-sm-6">
                            <div class="card card-stats">
                                <div class="card-content">
                                    <p class="category">Retired</p>
                                    <h1 class="title">{{$lead[3][1]}}</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="box">
                <div class="box-body">
                    <div class="col-lg-12">
                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <div class="card card-stats">
                                <div class="card-content">
                                    <p class="category"></p>
                                    <h1 class="title">QUOTE</h1>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-6 col-sm-6">
                            <div class="card card-stats">
                                <div class="card-content">
                                    <p class="category">UnQualified</p>
                                    <h1 class="title">{{$quote[0][1]}}</h1>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-6 col-sm-6">
                            <div class="card card-stats">
                                <div class="card-content">
                                    <p class="category">Qualified</p>
                                    <h1 class="title">{{$quote[1][1]}}</h1>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-6 col-sm-6">
                            <div class="card card-stats">
                                <div class="card-content">
                                    <p class="category">Converted</p>
                                    <h1 class="title">{{$quote[2][1]}}</h1>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-6 col-sm-6">
                            <div class="card card-stats">
                                <div class="card-content">
                                    <p class="category">Retired</p>
                                    <h1 class="title">{{$quote[3][1]}}</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="box">
                <div class="box-body">
                    <div class="col-lg-12">
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="card card-stats">
                                <div class="card-content">
                                    <p class="category"></p>
                                    <h1 class="title">AGREEMENT</h1>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="card card-stats">
                                <div class="card-content">
                                    <p class="category">Contract</p>
                                    <h1 class="title">{{$agree[0][1]}}</h1>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="card card-stats">
                                <div class="card-content">
                                    <p class="category">Amandement</p>
                                    <h1 class="title">{{$agree[1][1]}}</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="box">
                <div class="box-body">
                    <div class="col-lg-12">
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="card card-stats">
                                <div class="card-content">
                                    <p class="category"></p>
                                    <h1 class="title">ORDER</h1>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-1 col-md-6 col-sm-6">
                            <div class="card card-stats">
                                <div class="card-content">
                                    <p class="category">Pending</p>
                                    <h1 class="title">{{$order[0][1]}}</h1>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-1 col-md-6 col-sm-6">
                            <div class="card card-stats">
                                <div class="card-content">
                                    <p class="category">Submitted</p>
                                    <h1 class="title">{{$order[1][1]}}</h1>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-1 col-md-6 col-sm-6">
                            <div class="card card-stats">
                                <div class="card-content">
                                    <p class="category">InProgress</p>
                                    <h1 class="title">{{$order[2][1]}}</h1>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="card card-stats">
                                <div class="card-content">
                                    <p class="category">Complete</p>
                                    <h1 class="title">{{$order[3][1]}}</h1>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-1 col-md-6 col-sm-6">
                            <div class="card card-stats">
                                <div class="card-content">
                                    <p class="category">Failed</p>
                                    <h1 class="title">{{$order[4][1]}}</h1>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="card card-stats">
                                <div class="card-content">
                                    <p class="category">Cancelled</p>
                                    <h1 class="title">{{$order[5][1]}}</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection