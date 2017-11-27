<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>xqking</title>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no"/>
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" href="/img/20150820180003_ZXmkB.thumb.700_0.png">

    <link rel="stylesheet" href="/wechat/flexslider/flexslider.css">
    <link rel="stylesheet" href="/wechat/css/common.css">
    <script src="/wechat/js/fontSize.js"></script>
    @yield('css')
    <style>
        #wrapper {
            display: none;
        }
    </style>
</head>
<body>
<div id="globalLoading" class="global-loading">
    <div class="global-loading-logo">
        <div id="globalLoadingAnim" class="global-loading-anim"></div>
    </div>
    <div class="global-loading-text">正在努力为您加载中...</div>
</div>
<script src="/wechat/js/loading.js"></script>


<div id="wrapper">
    @yield('content')
</div>

<script src="/js/jquery.min.js"></script>
<script src="/js/destroy.js"></script>
<script src="/wechat/js/fastclick.js"></script>
<script src="/wechat/js/common.js"></script>
<script defer src="/wechat/flexslider/jquery.flexslider.js"></script>
<script type="text/javascript">
    $(window).load(function () {
        $('.flexslider').flexslider({
            animation: "slide",
            directionNav: false
        });
    });
    window.onload = function () {
        $('#wrapper').attr('style', 'display:block')
    }
</script>
@yield('js')
</body>
</html>