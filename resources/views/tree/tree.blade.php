<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/themes/default/style.min.css" />
    </head>
    <body>
        <div id="jstree">
        </div>
    </body>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/jstree.min.js"></script>
    <script>
        $(function() {
            {{--$('#tree').jstree({--}}
                {{--'core' : {--}}
                    {{--'data': {--}}
                        {{--'dataType': 'json',--}}
                        {{--'type' : 'get',--}}
                        {{--'url': function (node) {--}}
                            {{--return node.id === '#' ? '{{$data}}' : [];--}}
                        {{--},--}}
                        {{--'data': function (node) {--}}
                            {{--return {'id': node.id};--}}
                        {{--}--}}
                    {{--}--}}
                {{--}--}}
            {{--});--}}
            $('#jstree').jstree({ 'core' : {
                'data' : [
                    { "id" : "ajson1", "parent" : "#", "text" : "Simple root node" },
                    { "id" : "ajson2", "parent" : "#", "text" : "Root node 2" },
                    { "id" : "ajson3", "parent" : "ajson2", "text" : "Child 1" },
                    { "id" : "ajson4", "parent" : "ajson2", "text" : "Child 2" },
                ]
            } });
        });
    </script>
</html>