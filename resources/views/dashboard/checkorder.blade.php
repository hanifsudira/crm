@extends('dashboard.app')
@section('title', 'Check Order')
@section('content')
    <section class="content-header">
        <h1>Order</h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li>Oracle</li>
            <li class="active">Check Order</li>
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
                            <div style="overflow-x:auto;">
                                <table id="datatable" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>ORDER_NUM</th>
                                        <th>ROW_ID</th>
                                        <th>INT_ID</th>
                                        <th>ORDER_SUBTYPE</th>
                                        <th>REV</th>
                                        <th>PRODUCT</th>
                                        <th>OH_STATUS</th>
                                        <th>LI_STATUS</th>
                                        <th>MILESTONE</th>
                                        <th>CREATED_AT</th>
                                        <th>FULFILL_STATUS</th>
                                        <th>ACC_NAS</th>
                                        <th>NIPNAS</th>
                                        <th>SID_NUM</th>
                                        <th>LI_STATUS_INT</th>
                                        <th>MILE_STATUS_INT</th>
                                        <th>INT_NOTE</th>
                                        <th>Catatan</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
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
                        url     : '{{ route('ora.getcheckorder') }}',
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