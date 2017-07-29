<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Feedback New CRM</title>
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
    <div class="login-box">
        <div class="login-logo">Feedback New CRM</div>
        <div class="login-box-body">
            <p class="login-box-msg"><a href="https://produk.telkom.co.id/servlet/tk/id_ID/homepage/feedback.html" target="_black">Feedback DTP</a></p>

            <form action="{{ Route('feedback.store') }}" method="post" enctype="multipart/form-data">
                <div class="form-group has-feedback">
                    <label>NIK</label>
                    <input name="nik" type="text" class="form-control" placeholder="NIK Anda">
                    <span class="glyphicon glyphicon-barcode form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <label>Nama</label>
                    <input name="nama" type="text" class="form-control" placeholder="Nama Anda">
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <label>Feedback</label>
                    <textarea name="feedback" class="form-control" rows="3" placeholder="Input Feedback"></textarea>
                </div>
                <div class="form-group has-feedback">
                    <label for="exampleInputFile">Input Gambar</label>
                    <input type="file" name='image' id="exampleInputFile">
                </div>
                <div class="row">
                    <div class="col-xs-8">
                    </div>
                    <div class="col-xs-4">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">Submit</button>
                    </div>
                </div>
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
            </form>

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
