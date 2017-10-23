<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Segment</title>
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
    <style>
        table.scroll {
            /* width: 100%; */ /* Optional */
            /* border-collapse: collapse; */
            border-spacing: 0;
            border: 2px solid black;
        }

        table.scroll tbody,
        table.scroll thead { display: block; }

        thead tr th {
            height: 30px;
            line-height: 30px;
            /* text-align: left; */
        }

        table.scroll tbody {
            height: 100px;
            overflow-y: auto;
            overflow-x: hidden;
        }

        tbody { border-top: 2px solid black; }

        tbody td, thead th {
            /* width: 20%; */ /* Optional */
            border-right: 1px solid black;
            /* white-space: nowrap; */
        }

        tbody td:last-child, thead th:last-child {
            border-right: none;
        }
    </style>
</head>
<body class="hold-transition login-page">
<div class="tab-pane" id="summary">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                @if($count>0)
                    <div class="box-body">
                        <a href="{{ Route('report.downloadsegmentdetail',$param) }}" class="btn btn-app" id="btn-upload"><i class="fa fa-cloud-upload"></i>Export Excel</a>
                    </div>
                @endif
                <div class="box-body">
                    <h1>Segment Detail</h1>
                    <table id="datatable" class="table table-bordered table-striped" style="overflow-x: scroll;">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>ORDER_NUM</th>
                            <th>AGREE_NUM</th>
                            <th>AGREE_NAME</th>
                            <th>REV</th>
                            <th>STATUS</th>
                            <th>TYPE</th>
                            <th>START_DATE</th>
                            <th>END_DATE</th>
                            <th>NUM_PARENT</th>
                            <th>REV_PARENT</th>
                            <th>SEGMEN</th>
                            <th>SID_NUM</th>
                            <th>CC</th>
                            <th>AM_PRIMARY</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $i => $d)
                            <tr>
                                <td>{{$i+1}}</td>
                                <td>{{$d->ORDER_NUM}}</td>
                                <td>{{$d->AGREE_NUM}}</td>
                                <td>{{$d->AGREE_NAME}}</td>
                                <td>{{$d->REV}}</td>
                                <td>{{$d->STATUS}}</td>
                                <td>{{$d->TYPE}}</td>
                                <td>{{$d->START_DATE}}</td>
                                <td>{{$d->END_DATE}}</td>
                                <td>{{$d->NUM_PARENT}}</td>
                                <td>{{$d->REV_PARENT}}</td>
                                <td>{{$d->SEGMEN}}</td>
                                <td>{{$d->SID_NUM}}</td>
                                <td>{{$d->CC}}</td>
                                <td>{{$d->AM_PRIMARY}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
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
        var $table = $('table#datatable'),
            $bodyCells = $table.find('tbody tr:first').children(),
            colWidth;

        $(window).resize(function() {
            // Get the tbody columns width array
            colWidth = $bodyCells.map(function() {
                return $(this).width();
            }).get();

            // Set the width of thead columns
            $table.find('thead tr').children().each(function(i, v) {
                $(v).width(colWidth[i]);
            });
        }).resize(); // Trigger resize handler
    });
</script>
</body>
</html>
