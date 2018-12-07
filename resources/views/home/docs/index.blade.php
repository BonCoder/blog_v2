<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Bob</title>
</head>
<body>
<style>
    * {
        padding: 0;
        margin: 0;
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
    }

    #h1-blog_v2-api- {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        margin: 0;
        padding: 0 20px;
        height: 60px;
        line-height: 60px;
        background: #ffffff;
        z-index: 99999;
        font-size: 24px;
    }

    .markdown-toc {
        position: fixed;
        left: 0;
        top: 60px;
        bottom: 0;
        z-index: 99999;
        width: 170px;
        background: #ffffff;
        border-right: 1px solid #e6e6e6;
    }

    #test-editormd-view {
        position: fixed;
        left: 170px;
        top: 60px;
        right: 0;
        bottom: 0;
        padding: 15px;
        width: calc(100% - 170px);
    }
    .markdown-body ol, .markdown-body ul{
        padding-left: 0!important;
    }
    .markdown-toc-list li{
        list-style: none;
        padding-left: 15px;
    }
    .markdown-toc-list a{
        display: block;
        height: 30px;
        line-height: 30px;
        text-decoration: none!important;
    }
</style>
<link rel="stylesheet" href="{{asset('vendor/markdown/css/editormd.min.css')}}"/>
<link rel="stylesheet" href="http://yandex.st/highlightjs/6.2/styles/googlecode.min.css">

<div id="test-editormd-view" class="admin-editormd">
    <textarea>{{ $docs }}</textarea>
</div>

<!--如果在页面其他位置引入过jquery，此处引用可以删除-->
<script src="{{asset('vendor/markdown/js/jquery.min.js')}}"></script>
<script src="{{asset('vendor/markdown/js/editormd.min.js')}}"></script>
<script src="{{asset('vendor/markdown/lib/marked.min.js')}}"></script>
<script src="{{asset('vendor/markdown/lib/prettify.min.js')}}"></script>
<script type="text/javascript">
    $(function () {
        editormd.markdownToHTML("test-editormd-view", {
            htmlDecode: "style,script,iframe",  // you can filter tags decode
            emoji: false,
            taskList: true,
            tex: false,  // 默认不解析
            flowChart: false,  // 默认不解析
            sequenceDiagram: false,  // 默认不解析
            autoHeight: true,
        });
        $(".markdown-toc-list a[href='#请求地址']").parent().hide();
        $(".markdown-toc-list a[href='#请求参数']").parent().hide();
        $(".markdown-toc-list a[href='#返回体']").parent().hide();
        $(".markdown-toc-list a[href='#返回字段']").parent().hide();
    });
</script>
</body>
</html>