@extends('layouts.admin.application')
@section('css')
    <link rel="stylesheet" href="/css/ditu.css"/>
@endsection

@section('content')
    <div id="container" style="top:50px;"></div>
@endsection
@section('js')
    <script type="text/javascript"
            src="https://webapi.amap.com/maps?v=1.4.0&key=a08d137e28064f4a45edb0cb19b7eb8b&plugin=AMap.Autocomplete,AMap.PlaceSearch"></script>
    <script type="text/javascript" src="/js/ditu.js"></script>
@endsection