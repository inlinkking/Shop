@extends('layouts.wechat.application')
@section('css')
    <style>
        .content {
            margin-left: 120px;
        }

        .order-numbers {
            display: inline-block;
            position: absolute;
            background-color: #f23030;
            border-radius: 8px;
            padding: 0 8px;
            font-size: 8px;
            margin-right: 10px;
            color: #fff;
            right: -9px;
            border: 1px solid #fff;
        }
    </style>
@endsection
@section('content')
    <div class="page-product-view" data-log="商品详情">
        <div class="header">
            <div class="left">
                <img src="http://s1.mi.com/m/images/m/icon_back_n.png" class="ib" border="0"
                     onclick="javascript:history.back(-1);" title="返回上一页">
            </div>
            <div class="tit"><h2 data-log="HEAD-标题-商品详情"><span class="title">商品详情</span></h2></div>
            <div class="right">
                <a href="/product/search">
                    <div class="icon icon-search"></div>
                </a>
            </div>
        </div>
        <div class="product-view">
            <section class="slider">
                <div class="flexslider">
                    <ul class="slides">
                        @foreach($shows->product_galleries as $show)
                            <li>
                                <img style="height: 200px;" src="{{$show->img}}">
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="b2">
                    <div class="b21">
                        <div class="b211">
                            <div class="name">
                                <p>{{$shows->name}}</p>
                            </div>
                            <div class="price">
                                <strong>{{$shows->price}}元</strong>
                            </div>
                        </div>
                        <div class="b212">
                            <div class="icon-fenxiang"></div>
                        </div>
                    </div>
                    <div class="b22">
                        <p>{{$shows->description}}</p>
                    </div>
                </div>
                <div class="mt20" style="display: none;"></div>
                <ul class="b3">
                    <li>
                        <span>@if($shows->stock != '-1'){{$shows->stock}} @else 无限 @endif 件</span>
                    </li>
                </ul>
                <ul class="b3" style="display: none;">
                    <li><span class="on">白色</span></li>
                </ul>

                <ul class="b3" style="display: none;">
                    <li><span>通用</span></li>
                </ul>

                <div class="ui-b7">
                    <h3>为您推荐</h3>
                    <div class="ui-carousel-container">
                        <div class="ui-carousel-viewport">
                            @foreach($recommends as $recommend)
                                <a href="/product/{{$recommend->id}}">
                                    <img src="{{$recommend->image}}">
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="b5">
                    <div class="b51"></div>
                    <div class="b52">
                        <div class="blc">
                            {!! $shows->markdown_html_code !!}
                        </div>
                    </div>
                </div>
                <div class="b7">
                    <div class="b70">
                        <a href="/">
                            <div class="icon-home"></div>
                        </a>
                    </div>
                    <div class="b72">
                        @if($shows->stock == 0)
                            <a href="javascript:void(0);" class="off">暂时缺货</a>
                        @else
                            <a href="javascript:void(0);" id="add_to_cart">加入购物车</a>
                        @endif
                    </div>

                    <div class="b73">
                        <a href="/cart">
                            <em class="btm-act-icn" id="shoppingCart">
                                <i class="order-numbers" id="carNum">{{$cart['num']}}</i>
                            </em>
                            <div class="icon-gouwuche"></div>
                        </a>
                    </div>

                </div>
                <a href="javascript:void(0);" id="top" style="visibility: visible;">
                    <img src="http://s1.mi.com/m/images/m/top.png">
                </a>
            </section>
        </div>
        <div class="share-component"></div>
    </div>
@endsection
@section('js')
    <script>
        $(function () {
//            $(window).scroll(function () {
//                var topDistance = $(window).scrollTop();  //获取鼠标在本窗口现有状态下移动的高度
//                if (topDistance > 100) {  //如果移动高度大于100px,顶部图标单单显示出，如果移动高度小于等于100，顶部图标不显示
//                    $('#top').fadeIn(800);
//                } else {
//                    $('#top').fadeOut(800);
//                }
//            });
            $('#top').on('click', function () {
                $('html,body').animate({scrollTop: 0}, 800); //必须用$('html,body')选择，不然没效果
            });
            $("#add_to_cart").click(function () {
                var $num = $('#carNum');
                var num = $num.text();
                num = parseInt(num) + 1;
                $num.text(num);
//                console.log(num);return false;
                $.ajax({
                    type: 'POST',
                    url: '/cart',
                    data: {product_id: "{{$shows->id}}"},
                    success: function (data) {
//                        location.href = '/cart';
                    }
                })
            })
        });
    </script>
@endsection