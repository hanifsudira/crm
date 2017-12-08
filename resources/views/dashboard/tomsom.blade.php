<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>View</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="{{ URL::asset('assets/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="{{ URL::asset('assets/dist/css/AdminLTE.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/iCheck/square/blue.css') }}">
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
                <div class="box-body">
                    <h1>Noss</h1>
                    <table id="datatable" class="table table-bordered table-striped" style="overflow-x: scroll;">
                        <thead>
                        <tr>
                            <th>LogID</th>
                            <th>External ID</th>
                            <th>Type</th>
                            <th>Siebel ID</th>
                            <th>Product Order</th>
                            <th>Description</th>
                            <th>Trans Date</th>
                            <th>Last Date</th>
                            <th>Iteration</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($noss as $d)
                            <tr>
                                <td>{{$d[0]}}</td>
                                <td>{{$d[1]}}</td>
                                <td>{{$d[2]}}</td>
                                <td>{{$d[3]}}</td>
                                <td>{{$d[4]}}</td>
                                <td>{{$d[5]}}</td>
                                <td>{{$d[6]}}</td>
                                <td>{{$d[7]}}</td>
                                <td>{{$d[8]}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body">
                    <h1>Tenoss</h1>
                    <table id="datatable" class="table table-bordered table-striped" style="overflow-x: scroll;">
                        <thead>
                        <tr>
                            <th>LogID</th>
                            <th>External ID</th>
                            <th>Service ID</th>
                            <th>Service OrderID</th>
                            <th>Description</th>
                            <th>Trans Date</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($tenoss as $d)
                            <tr>
                                <td>{{$d[0]}}</td>
                                <td>{{$d[1]}}</td>
                                <td>{{$d[2]}}</td>
                                <td>{{$d[3]}}</td>
                                <td>{{$d[4]}}</td>
                                <td>{{$d[5]}}</td>
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
<script>
    $(function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' // optional
        });
    });
</script>
</body>
</html>
