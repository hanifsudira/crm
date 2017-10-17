<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>View</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="{{ URL::asset('assets/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="{{ URL::asset('assets/dist/css/AdminLTE.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/iCheck/square/blue.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/alertify.js/0.5.0/alertify.core.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/alertify.js/0.5.0/alertify.default.min.css">
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/alertifyjs/css/alertify.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/alertifyjs/css/themes/bootstrap.css') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page">
<div class="tab-pane" id="summary">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                @if($count>0)
                    <div class="box-body">
                        <a href="{{ Route('report.download',$param) }}" class="btn btn-app" id="btn-upload"><i class="fa fa-cloud-upload"></i>Export Excel</a>
                    </div>
                @endif
                <div class="box-body">
                    <h1>Order Detail</h1>
                    <table id="datatable" class="table table-bordered table-striped" style="overflow-x: scroll;">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>ORDER_NUM</th>
                            <th>ORDER_SUBTYPE</th>
                            <th>ROW_ID</th>
                            <th>INT_ID</th>
                            <th>PRODUCT</th>
                            <th>INT_NOTE</th>
                            <th>SEGMENT</th>
                            <th>CC</th>
                            <th>SID_NUM</th>
                            <th>Follow Up By</th>
                            <th>Action Note</th>
                            <th>ACTION</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $i => $d)
                            <tr>
                                <td>{{$i+1}}</td>
                                <td>{{$d->order_num}}</td>
                                <td>{{$d->order_subtype}}</td>
                                <td>{{$d->row_id}}</td>
                                <td>{{$d->INT_ID}}</td>
                                <td>{{$d->product}}</td>
                                <td>{{$d->int_note}}</td>
                                <td>{{$d->SEGMENT}}</td>
                                <td>{{$d->CC}}</td>
                                <td>{{$d->SID_NUM}}</td>
                                <td>{{$d->fuby}}</td>
                                <td>{{$d->fus_note}}</td>
                                <td><button type="button" class="btn btn-warning" data-toggle="modal" data-target="#actionModal"  data-ordernum="{{$d->order_num}}" data-rowid="{{$d->row_id}}">Action</button></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="modal fade" id="actionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="exampleModalLabel">Action - <span id="append"></span></h4>
                            </div>
                            <div class="modal-body">
                                <form id="myActionForm" class="modalform" >
                                    {{ csrf_field() }}
                                    <input type="hidden" id="rowid" name="rowid">
                                    <div class="form-group">
                                        <label for="recipient-name" class="control-label">Follow Up By</label>
                                        <input type="text" class="form-control" id="fuby" name="fuby">
                                    </div>
                                    <div class="form-group">
                                        <label for="recipient-name" class="control-label">Solved By</label>
                                        <input type="text" class="form-control" id="sby" name="sby">
                                    </div>
                                    <div class="form-group">
                                        <label for="message-text" class="control-label">Note</label>
                                        <textarea class="form-control" id="fus_note" name="note"></textarea>
                                    </div>
                                    <input type="submit" class="btn btn-primary">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ URL::asset('assets/plugins/alertifyjs/alertify.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/jQuery/jquery-2.2.3.min.js') }}"></script>
<script src="{{ URL::asset('assets/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/iCheck/icheck.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/alertify.js/0.5.0/alertify.min.js"></script>
<script>
    $(document).ready(function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' // optional
        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#actionModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var finaltext = 'ORDER NUM : '+ button.data('ordernum') + ' ROW ID : ' + button.data('rowid');
            $(this).find('#append').text(finaltext);
            var modal = $(this);
            modal.find('#rowid').val(button.data('rowid'));
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type    : 'GET',
                url     : '{{ route('report.getorderactiondetail') }}',
                datatype: 'JSON',
                data    : {
                    order: button.data('ordernum'),
                    rowid: button.data('rowid')
                },
                complete : function (result) {
                    console.log(result.responseText);
                    var data = JSON.parse(result.responseText);
                    modal.find('#fuby').val(data.fuby);
                    modal.find('#sby').val(data.sby);
                    modal.find('#fus_note').val(data.note);
                }
            });
        });
        $('#myActionForm').on('submit', function (event) {
            $.ajax({
                url     : '{{ route('report.storedetailaction') }}',
                type    : 'POST',
                beforeSend: function (xhr) {
                    var token = $('meta[name="csrf_token"]').attr('content');

                    if (token) {
                        return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                    }
                },
                data    : $('#myActionForm').serialize(),
                complete: function (result) {
                    var data = JSON.parse(result.responseText);
                    $('#actionModal').modal('hide');
                    if(data.status){
                        alertify.success('Berhasil');
                    }
                    else {
                        alertify.error('Gagal');
                    }

                }
            });
            event.preventDefault();
        });
    });
</script>
</body>
</html>
