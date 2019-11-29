<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bob的博客-PHP-Java-mysql--Bob的博客|技术博客|个人博客</title>
    <meta name="description" content="Bob的博客,Linux,Windows,bobcoder,个人主页,php,java,技术博客,个人博客,mysql,nginx,Bob,laravel">
    <meta name="robots" content="all,follow">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{--css--}}
    <link href="{{ mix('css/app.css') }}" rel="stylesheet" type="text/css"/>
    <!-- Favicon-->
    <link href="/favicon.ico" rel="shortcut icon">
</head>
<body >
    <div id="app"></div>
<script src="{{mix('/js/manifest.js')}}"></script>
<script src="{{mix('/js/vendor.js')}}"></script>
<script src="{{mix('/js/app.js') }}"></script>

<!--<script type="text/javascript" src="https://mozilan.geekadpt.cn/lvblog/public/js/app.js"></script>-->

</body>
</html>