{{--Created by PhpStorm.--}}
{{--User: xieqi--}}
{{--Date: 2017/9/7--}}
{{--Time: 12:31--}}
        <!doctype html>
<html class="no-js fixed-layout">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>my-xieqing</title>
    <meta name="description" content="这是一个 index 页面">
    <meta name="keywords" content="index">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" href="/vendor/amazeui/assets/i/favicon.png"/>
    <link rel="apple-touch-icon-precomposed" href="/vendor/amazeui/assets/i/app-icon72x72@2x.png"/>
    <meta name="apple-mobile-web-app-title" content="Amaze UI"/>
    <link rel="stylesheet" href="/vendor/amazeui/assets/css/amazeui.min.css"/>
    <link rel="stylesheet" href="/vendor/amazeui/assets/css/admin.css"/>
    <link rel="stylesheet" href="/vendor/amazeui/css/common.css"/>
    <link rel='stylesheet' href="/vendor/nprogress/nprogress.css"/>
    <link rel="stylesheet" href="/css/admin.css">
    @yield('css')
</head>
<body>
<!--[if lte IE 9]>
<p class="browsehappy">你正在使用<strong>过时</strong>的浏览器，Amaze UI 暂不支持。
    请 <a href="http://browsehappy.com/" target="_blank">升级浏览器</a>
    以获得更好的体验！</p>
<![endif]-->

@include('layouts.admin._headr')

<div class="am-cf admin-main">
    @include('layouts.admin._sitebar')

    @yield('content')
</div>
<script src="/vendor/amazeui/assets/js/jquery.min.js"></script>
<script src="/vendor/amazeui/assets/js/amazeui.min.js"></script>
<script src="/vendor/amazeui/assets/js/app.js"></script>
<script src="/vendor/html5-fileupload/jquery.html5-fileupload.js"></script>
<script src="/vendor/nprogress/nprogress.js"></script>
<script src="/vendor/amazeui/js/common.js"></script>
<script src="/js/destroy.js"></script>
<script src="/js/echarts.min.js"></script>
<script src="/js/admin.js"></script>
@yield('js')
</body>
</html>
