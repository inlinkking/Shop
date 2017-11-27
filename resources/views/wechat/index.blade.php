@extends('layouts.wechat.application')

@section('content')
    <div class="page-index" id="home" data-log="首页">
        <div class="index-header">
            <div class="search_bar">
                <a href="/product/search">
                    <span class="icon icon-search"></span>
                    <span class="text">搜索商品名称</span>
                </a>
            </div>
            <div class="search_bottom"></div>
        </div>
        <!--焦点图-->
        <section class="slider">
            <div class="flexslider">
                <ul class="slides">
                    @foreach($wechat as $p)
                        <li>
                            <a href="{{$p->url}}">
                                <img src="{!! $p->image !!}"/>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </section>
        <!--推荐商品-->
        <div class="list">
            <div class="section">
                <div class="mcells_auto_fill">
                    <div class="body">
                        @foreach($wechats as $wec)
                            <div>
                                <div class="items" onclick="location.href='{{$wec->url}}'">
                                    <img src="{{$wec->image}}">
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @foreach($product as $produ)
                <div class="section" onclick="location.href='/product/{{$produ->id}}'">
                    <div>
                        <div class="item">
                            <div class="img">
                                @if($produ->image)
                                    <img src="{{$produ->image}}" class="ico">
                                @endif
                                @if($produ->is_new)
                                    <img class="tag " src="/wechat/images/new.png">
                                @elseif($produ->is_selling)
                                    <img class="tag " src="/wechat/images/hot.png">
                                @endif
                            </div>
                            <div class="info">
                                <div class="name"><p>{{$produ->name}}</p></div>
                                <div class="brief"><p>{{$produ->description}}</p></div>
                                <div class="price"><p>{{$produ->price}}元 起</p></div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    @include('layouts.wechat._headr')
@endsection