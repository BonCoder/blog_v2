<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Bob</title>
</head>
<body>
<link rel="stylesheet" href="{{asset('vendor/markdown/css/editormd.min.css')}}" />
<div class="layui-col-sm4">

    <div class="layui-card">

        <div class="layui-card-body">
            <style>
                .tips {
                    display: -webkit-flex;
                    display: -moz-flex;
                    display: flex;
                }

                .tips .tips-item {
                    flex: 1;
                    text-align: right;
                }
            </style>
            <ul class="layuiadmin-card-status layuiadmin-home2-usernote">

                <li>

                    <h3>{{$article->title}}</h3>

                    <div id="test-editormd-view2" class="admin-editormd">
                        <textarea>{{ $article->content }}</textarea>
                    </div>

                    <div class="tips">
                        <span>{{$article->created_at}}</span>
                        <div class="tips-item">
                            @foreach ($article->tags as $tag)
                            <a class="layui-btn layui-btn-xs">{{ $tag->name }}</a>
                            @endforeach
                        </div>
                    </div>
                </li>
            </ul>

        </div>

    </div>

</div>


<!--如果在页面其他位置引入过jquery，此处引用可以删除-->
<script src="{{asset('vendor/markdown/js/jquery.min.js')}}"></script>
<script src="{{asset('vendor/markdown/js/editormd.min.js')}}"></script>
<script src="{{asset('vendor/markdown/lib/marked.min.js')}}"></script>
<script src="{{asset('vendor/markdown/lib/prettify.min.js')}}"></script>
<script type="text/javascript">
    $(function () {
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