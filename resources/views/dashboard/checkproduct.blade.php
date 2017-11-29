@extends('dashboard.app')
@section('title', 'Check Product')
@section('content')
    <section class="content-header">
        <h1>Check Product</h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li>Oracle</li>
            <li class="active">Check Product</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="search-form">
                    <div class="input-group">
                        <input type="text" id="ordernum" name="search" class="form-control" placeholder="Search">
                    </div>
                </div>
            </div>
        </div>
        <div id="response">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-body">
                            <h1>Result</h1>
                            <table id="datatable" class="table table-bordered table-striped" style="overflow-x: scroll;">
                                <thead>
                                <tr>
                                    <th>PRODUCT</th>
                                    <th>STATUS</th>
                                    <th>SERVICE_ID</th>
                                    <th>BA</th>
                                    <th>BP</th>
                                    <th>START_DATE</th>
                                    <th>END_DATE</th>
                                    <th>BILL_START</th>
                                    <th>AGREEMENT</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="loading-image" style="display: none"></div>
    </section>
@endsection
@section('css')
    <style>
        #loading-image{
            position:fixed;
            top:0px;
            right:0px;
            width:100%;
            height:100%;
            background-color:#666;
            background-image:url('{{ URL::asset('assets/img/loader.gif')}}');
            background-repeat:no-repeat;
            background-position:center;
            z-index:10000000;
            opacity: 0.4;
        }
    </style>
@endsection
@section('js')
    <script type="text/javascript">
        $(document).ready(function() {
            $("#ordernum").on('keyup', function (e) {
                if (e.keyCode == 13) {
                    e.preventDefault();
                    var ordernum = $("#ordernum").val();
                    $('#loading-image').show();
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type    : 'POST',
                        url     : '{{ route('ora.getcheckproduct') }}',
                        data    : {order: ordernum},
                        succes  : function () {
                            console.log('Sukses');
                        },
                        error   : function (xhr, status, error) {
                            console.log(xhr);
                            console.log(status);
                            console.log(error);
                        },
                        complete : function (result) {
                            $('#loading-image').hide();
                            console.log(result);
                            $('#response').html(result.responseText);
                        }
                    });
                }
            });
        });
    </script>
@endsection