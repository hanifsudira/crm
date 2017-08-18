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
                        <div class="col-lg-2 col-md-6 col-sm-6">
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
                    <div class="col-lg-12">
                        <div class="col-lg-2 col-md-6 col-sm-6">
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
                                    <p class="category">HI</p>
                                    <h1 class="title">1</h1>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-6 col-sm-6">
                            <div class="card card-stats">
                                <div class="card-content">
                                    <p class="category">MTD</p>
                                    <h1 class="title">1</h1>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-6 col-sm-6">
                            <div class="card card-stats">
                                <div class="card-content">
                                    <p class="category">ACH MTD</p>
                                    <h1 class="title">1</h1>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-6 col-sm-6">
                            <div class="card card-stats">
                                <div class="card-content">
                                    <p class="category">RANK TR2</p>
                                    <h1 class="title">1</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="col-lg-2 col-md-6 col-sm-6">
                            <div class="card card-stats">
                                <div class="card-content">
                                    <p class="category"></p>
                                    <h1 class="title">AGREEMENT</h1>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-6 col-sm-6">
                            <div class="card card-stats">
                                <div class="card-content">
                                    <p class="category">HI</p>
                                    <h1 class="title">1</h1>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-6 col-sm-6">
                            <div class="card card-stats">
                                <div class="card-content">
                                    <p class="category">MTD</p>
                                    <h1 class="title">1</h1>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-6 col-sm-6">
                            <div class="card card-stats">
                                <div class="card-content">
                                    <p class="category">ACH MTD</p>
                                    <h1 class="title">1</h1>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-6 col-sm-6">
                            <div class="card card-stats">
                                <div class="card-content">
                                    <p class="category">RANK TR2</p>
                                    <h1 class="title">1</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="col-lg-2 col-md-6 col-sm-6">
                            <div class="card card-stats">
                                <div class="card-content">
                                    <p class="category"></p>
                                    <h1 class="title">ORDER</h1>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-6 col-sm-6">
                            <div class="card card-stats">
                                <div class="card-content">
                                    <p class="category">HI</p>
                                    <h1 class="title">1</h1>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-6 col-sm-6">
                            <div class="card card-stats">
                                <div class="card-content">
                                    <p class="category">MTD</p>
                                    <h1 class="title">1</h1>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-6 col-sm-6">
                            <div class="card card-stats">
                                <div class="card-content">
                                    <p class="category">ACH MTD</p>
                                    <h1 class="title">1</h1>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-6 col-sm-6">
                            <div class="card card-stats">
                                <div class="card-content">
                                    <p class="category">RANK TR2</p>
                                    <h1 class="title">1</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection