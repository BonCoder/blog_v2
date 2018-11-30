<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Bob</title>
</head>
<body>
<link rel="stylesheet" href="{{asset('vendor/markdown/css/editormd.min.css')}}" />
<div id="test-editormd-view2" class="admin-editormd">
    <textarea>{{ $doc }}</textarea>
</div>


<!--如果在页面其他位置引入过jquery，此处引用可以删除-->
<script src="{{asset('vendor/markdown/js/jquery.min.js')}}"></script>
<script src="{{asset('vendor/markdown/js/editormd.min.js')}}"></script>
<script src="{{asset('vendor/markdown/lib/marked.min.js')}}"></script>
<script src="{{asset('vendor/markdown/lib/prettify.min.js')}}"></script>
<script type="text/javascript">
    $(function() {
        editormd.markdownToHTML("test-editormd-view2", {
            htmlDecode      : "style,script,iframe",  // you can filter tags decode
            emoji           : true,
            taskList        : true,
            tex             : true,  // 默认不解析
            flowChart       : true,  // 默认不解析
            sequenceDiagram : true,  // 默认不解析
            autoHeight      : true,
        });
    });
</script>
</body>
</html>