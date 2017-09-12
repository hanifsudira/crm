<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Amandment</title>
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/themes/default/style.min.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page">
<div class="tab-pane" id="summary">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body">
                    <h1>{{$order}}</h1>
                    <div id="jstree">

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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/jstree.min.js"></script>
<script>
    $(function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%'
        });

        $('#jstree').jstree({
            'core' : {
                'data': {
                    'dataType': 'json',
                    'type' : 'get',
                    'url' : function(node){
                        if(node.id === "#") {
                            return "{{route('ora.getroot',$order)}}";
                        }
                        else{
                            var aggnum = node.original.agg_num.replace('/','%2F');
                            var url = '{{route('ora.getchild',array(':id',':parent_num',':rev_num',':agg_num',':level'))}}';
                            url = url.replace(':id',node.original.id);
                            url = url.replace(':parent_num',node.original.parent_num);
                            url = url.replace(':rev_num',node.original.rev_num);
                            url = url.replace(':agg_num',aggnum);
                            url = url.replace(':level',node.original.level);
                            url = url.replace('}','');
                            console.log(url);
                            return url;
                        }
                    },
                    'success' : function(data){
                        return data;
                    },
                    'data': function (node) {
                        return {
                            'id'            : node.id,
                            'parent_num'    : node.parent_num,
                            'rev_num'       : node.rev_num,
                            'agg_num'       : node.agg_num,
                            'level'         : node.level
                        };
                    }
                }
            },
            'plugins': ["json_data","wholerow","dnd"],
        });

    });
</script>
</body>
</html>
