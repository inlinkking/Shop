@extends('layouts.wechat.application')
{{--@section('css')--}}
    {{--<style>--}}
        {{--.title {--}}
            {{--font-size: 14px;--}}
            {{--padding: 0 0 10px 15px;--}}
        {{--}--}}

        {{--.img {--}}
            {{--height: 100px;--}}
        {{--}--}}
    {{--</style>--}}
{{--@endsection--}}
@section('content')
    <div class="page-search" data-log="搜索页">
        <div class="header">
            <div class="left">
                <img src="http://s1.mi.com/m/images/m/icon_back_n.png" class="ib" border="0"
                     onclick="javascript:history.back(-1);" title="返回上一页">
            </div>
            <div class="tit">
                <div class="searchword">
                    <input autofocus="autofocus">
                </div>
            </div>
            <div class="searchlabel">
                <a>
                    <span class="icon icon-search"></span>
                </a>
            </div>
        </div>
        <div>
            <ul class="list-default">
                @foreach($product as $p)
                    <li @if($p->is_top == '1')class="top" @endif onclick="location.href='/product/{{$p->id}}'">
                        <span>{{$p->name}}</span>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $(function () {
            $(".icon-search").click(function () {
                var searchword = $.trim($(".searchword input").val());
                location.href = '/product?searchword=' + searchword;
            });
        })
    </script>
@endsection