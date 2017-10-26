<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Monitoring Agreement</title>
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

        html, body{
            height:100%;
            width:100%;
            padding:0;
            margin:0;
        }

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
                <div class="box-body">
                    <h1>Line Detail Agree Num : {{$agree}}</h1>
                    <table id="datatable" class="table table-bordered table-striped" style="overflow-x: scroll;">
                        <thead>
                        <tr>
                            <td>No</td>
                            <td>LAST_ORDER_NUM</td>
                            <td>PRODUCT</td>
                            <td>SID_NUM</td>
                        </tr>
                        </thead>
                        <tbody>
                        @if($data)
                            @foreach($data as $i => $d)
                                <tr>
                                    <td>{{$i+1}}</td>
                                    <td>{{$d[0]}}</td>
                                    <td>{{$d[1]}}</td>
                                    <td>{{$d[2]}}</td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        @endif
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
