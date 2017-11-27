@extends('layouts.wechat.application')
@section('css')
    <style>
        .cart-index-wrap .item .choose {
            width: .6rem;
            padding: 0 .2rem;
            height: 1.8rem;
        }

        .cart-index-wrap .item .choose.status-1 {
            background: url(/img/check_press.png) 50% 50% no-repeat;
            -webkit-background-size: .4rem .4rem;
            -moz-background-size: .4rem .4rem;
            -ms-background-size: .4rem .4rem;
            -o-background-size: .4rem .4rem;
            background-size: .4rem .4rem;
        }

        .cart-index-wrap .item .choose.status-0 {
            background: url(/img/check_normal.png) 50% 50% no-repeat;
            -webkit-background-size: .4rem .4rem;
            -moz-background-size: .4rem .4rem;
            -ms-background-size: .4rem .4rem;
            -o-background-size: .4rem .4rem;
            background-size: .4rem .4rem;
        }
    </style>
@endsection
@section('content')
    <div class="header">
        <div class="left">
            <img src="http://s1.mi.com/m/images/m/icon_back_n.png" class="ib" border="0"
                 onclick="javascript:history.back(-1);" title="返回上一页">
        </div>
        <div class="tit"><h2 data-log="HEAD-标题-购物车"><span class="title">购物车</span></h2></div>
        <div class="right">
            <a href="/">
                <div class="icon-home icon"></div>
            </a>
        </div>
    </div>
    <div class="cart-index" id="more" @if (!$cart->isEmpty()) style="display: none;" @endif>
        <div style="height:1rem;"></div>
        <div class="cart-index-wrap">
            <div class="empt">
                <div class="b3">
                    <a href="/product/category" class="ui-button ui-button-disable">
                        <span>全部商品</span>
                    </a>
                    <a href="/" class="ui-button">
                        <span>精选商品</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="cart-index" id="carts" @if ($cart->isEmpty()) style="display: none;" @endif>
        <div class="cart-index-wrap">
            <div>
                <div class="cart-list">
                    <ul>
                        @foreach($cart as $carts)
                            <li class="item" data-id="{{$carts->id}}">
                                <div class="ui-box">
                                    <div class="choose @if($carts->is_show != 0) status-1 @else status-0
                                         @endif" id="child_{{$carts->id}}"></div>
                                    <div class="imgProduct">
                                        <a href="/product/{{$carts->product->id}}">
                                            <img src="{{$carts->product->image}}">
                                        </a>
                                    </div>
                                    <div class="info ui-box-flex">
                                        <div class="name">
                                            <span>{{$carts->product->name}}</span>
                                        </div>
                                        <div class="price">
                                            <p>
                                                <span>售价：</span>
                                                <span>{{doubleval($carts->product->price)}}元</span>
                                            </p>
                                            <div class="tip">
                                                <span style="display: none;">请于2016/04/11 00:58前下单，逾期将失效。</span>
                                            </div>
                                        </div>
                                        <div class="num" data-id="{{$carts->id}}"
                                             data-price="{{$carts->product->price}}">
                                            <div class="xm-input-number">
                                                <div class="input-sub @if($carts->num > 1) active @endif"></div>
                                                <div class="input-num">
                                                    <span>{{$carts->num}}</span>
                                                </div>
                                                <div class="input-add active"></div>
                                            </div>
                                            <div class="delete">
                                                <a href="javascript:void(0);">
                                                    <span class="icon-iconfontshanchu"></span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="append"></div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="pointBox">
                <div class="point" style="display: none;">
                    <span class="act act_special">包邮</span>
                    <span></span>
                </div>
                <div class="point">
                    <p>温馨提示：产品是否购买成功，以最终下单为准，请尽快结算</p>
                </div>
            </div>

            <!-- Navbar -->
            <div class="bottom-submit ui-box">
                <div class="price">
                    <span id="num">共{{$count['num']}}件 金额：</span>
                    <br>
                    <strong id="total_price">{{doubleval($count['total_price'])}}</strong>
                    <span>元</span>
                </div>
                <div class="btn">
                    <a class="ui-button ui-button-disable" href="/product/category">
                        <span>继续购物</span>
                    </a>
                </div>
                <div class="btn">
                    <a class="ui-button" href="/order/checkout">
                        <span>去结算</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $(function () {
            $(document).on('click', '.status-1', function () {
                $(this).addClass('status-0');
                $(this).removeClass('status-1');
                var id = $(this).parents('li').data('id');
//                console.log(info);
                $.ajax({
                    type: 'PATCH',
                    url: '/cart/delete',
                    data: {id: id},
                    success: function (data) {
                        $('#num').text('共' + data.num + '件 金额:');
                        $('#total_price').text(data.total_price);
                    }
                })

            });
            $(document).on('click', '.status-0', function () {
                $(this).addClass('status-1');
                $(this).removeClass('status-0');
                var id = $(this).parents('li').data('id');
                $.ajax({
                    type: 'PATCH',
                    url: '/cart/del',
                    data: {id: id},
                    success: function (data) {
                        $('#num').text('共' + data.num + '件 金额:');
                        $('#total_price').text(data.total_price);
                    }
                })
            });


            //删除
            $(".delete").click(function () {
                var _this = $(this);
                var info = {
                    id: _this.parents(".num").data('id')
                };
//                console.log(info);return false;
                $.ajax({
                    type: 'DELETE',
                    url: '/cart',
                    data: info,
                    success: function (data) {
                        var length = $(".item").length;
                        if (length == 1) {
                            $('#carts').hide();
                            $('#more').show();
                            return false;
                        }
                        $("#num").text("共" + data.num + "件 金额:");
                        $("#total_price").text(data.total_price);
                        _this.parents('.item').remove();
                    }
                })
            });


            //加
            $(".input-add").click(function () {
                var _this = $(this);
                var $num = _this.siblings('.input-num').children('span');
                var $sub = _this.siblings('.input-sub');
                var $add = _this.siblings('.input-add');
                var num = $num.text();
                num = parseInt(num) + 1;
                $num.text(num);
                if (!$sub.hasClass('active')) {
                    $sub.addClass('active');
                }

                $.ajax({
                    type: 'PATCH',
                    url: '/cart',
                    data: {
                        id: _this.parents('.num').data('id'),
                        type: 'add'
                    },
                    success: function (data) {
//                        console.log(data);
                        $('#num').text('共' + data.num + '件 金额:');
                        $('#total_price').text(data.total_price);
                    }
                })
            });


            //减
            $(".input-sub").click(function () {
                var _this = $(this);
                var $num = _this.siblings('.input-num').children('span');
                var num = $num.text();
                var price = _this.parents('.num').data('price');
                if (num == 1) {
                    _this.removeClass('active');
                }
                if (num == 1) {
                    return false;
                }
                num = parseInt(num) - 1;
                $num.text(num);
                $.ajax({
                    type: 'PATCH',
                    url: '/cart',
                    data: {
                        id: _this.parents('.num').data('id'),
                        type: 'sub'
                    },
                    success: function (data) {
                        $('#num').text('共' + data.num + '件 金额:');
                        $('#total_price').text(data.total_price);
                    }
                })
            });
        });
    </script>
@endsection