<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>xqking</title>
    <meta name="description" content="LogViewer">
    <meta name="author" content="ARCANEDEV">
    <link rel="stylesheet" href="/vendor/log-viewer/bootstrap.min.css">
    <link rel="stylesheet" href="/vendor/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="/vendor/log-viewer/bootstrap-datetimepicker.min.css">
    <link href='/vendor/log-viewer/font.css' rel='stylesheet' type='text/css'>
    @include('log-viewer::_template.style')

</head>
<body>
@include('log-viewer::_template.navigation')

<div class="container-fluid">
    @yield('content')
</div>
@include('log-viewer::_template.footer')
<script src="/js/jquery-3.1.0.min.js"></script>
<script src="/vendor/log-viewer/bootstrap.min.js"></script>
<script src="/vendor/log-viewer/moment-with-locales.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.3.0/Chart.min.js"></script>
<script src="/vendor/log-viewer/bootstrap-datetimepicker.min.js"></script>


<script>
    Chart.defaults.global.responsive = true;
    Chart.defaults.global.scaleFontFamily = "'Source Sans Pro'";
    Chart.defaults.global.animationEasing = "easeOutQuart";
</script>
@yield('modals')
@yield('scripts')
</body>
</html>
