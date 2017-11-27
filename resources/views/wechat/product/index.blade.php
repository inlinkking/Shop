@extends('layouts.wechat.application')

@section('content')
    <div class="page-list" data-log="商品列表">
        <div class="header">
            <div class="left">
                <img src="http://s1.mi.com/m/images/m/icon_back_n.png" class="ib" border="0"
                     onclick="javascript:history.back(-1);" title="返回上一页">
            </div>
            <div class="tit"><h2 data-log="HEAD-标题-商品列表"><span class="title">商品列表</span></h2></div>

            <div class="right">
                <a href="/product/search">
                    <div class="icon icon-search"></div>
                </a>
            </div>
        </div>
        <ol class="version">
            @foreach($products as $product)
                <li>
                    <a class="version-item" href="/product/{{$product->id}}">
                        <div class="version-item-img">
                            <img src="{{$product->image}}">
                        </div>
                        <div class="version-item-intro">
                            <div class="version-item-name"><p>{{$product->name}}</p></div>
                            <div class="version-item-intro-price"><span>{{doubleval($product->price)}}元</span></div>
                        </div>
                    </a>
                </li>
            @endforeach
        </ol>
    </div>
@endsection

