@extends('dashboard.app')
@section('title', 'Line Item')
@section('content')
    <section class="content-header">
        <h1>Line Items</h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li>Oracle</li>
            <li class="active">Line Items</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#data" data-toggle="tab">Data</a></li>
                        <li><a href="#summary" data-toggle="tab">Summary</a></li>
                    </ul>
                    <div class="tab-content">
                        <!-- DATA -->
                        <div class="tab-pane active" id="data">
                            <div class="row">
                            <div class="col-md-12">
                                <div class="box-header">
                                    <h1 class="box-title">Last Update : <a>Unknown</a></h1>
                                </div>
                            </div>
                        </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="box">
                                        <div class="box-body">
                                            <table id="datatable" class="table table-bordered table-striped">
                                                <thead>
                                                <tr>
                                                    <th>ORDER#</th>
                                                    <th>REV</th>
                                                    <th>PRODUCT</th>
                                                    <th>OH_STATUS</th>
                                                    <th>LI_STATUS</th>
                                                    <th>MILESTONE</th>
                                                    <th>ORDER_SUBTYPE</th>
                                                    <th>CREATED_AT</th>
                                                    <th>FULFILL_STATUS</th>
                                                    <th>ACC_NAS</th>
                                                    <th>NIPNAS</th>
                                                    <th>SID_NUM</th>
                                                </tr>
                                                </thead>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- SUMMARY -->
                        <div class="tab-pane" id="summary">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="box-header">
                                        <h1 class="box-title">Last Update : <a>Unknown</a></h1>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="box">
                                        <div class="box-body">
                                            <table id="summarytable" class="table table-bordered table-striped">
                                                <thead>
                                                <tr>
                                                    <th>OH_STATUS</th>
                                                    <th>LI_STATUS</th>
                                                    <th>MILESTONE</th>
                                                    <th>JUMLAH</th>
                                                </tr>
                                                </thead>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection