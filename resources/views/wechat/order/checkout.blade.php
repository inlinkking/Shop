@extends('layouts.wechat.application')
@section('css')
    <style>


    </style>
@endsection
@section('content')
    <div class="header">
        <div class="left">
            <img src="http://s1.mi.com/m/images/m/icon_back_n.png" class="ib" border="0"
                 onclick="javascript:history.back(-1);" title="返回上一页">
        </div>
        <div class="tit">
            <h2 data-log="HEAD-标题-下单">
                <span class="title">下单</span>
            </h2>
        </div>
        <div class="right">
            <a href="/">
                <div class="icon-home icon"></div>
            </a>
        </div>
    </div>

    @if($count['num'] ==0)

        <div class="ui-mask"></div>

        <div class="ui-pop">
            <div class="alert-dialog">
                <div class="ui-pop-content">
                    <div class="text">
                        <span>请勾选需要结算的商品</span>
                    </div>
                </div>
                <div class="ui-button-box" onclick="location.href='/cart'">
                    <div class="ui-button">
                        <p>确定</p>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="page-order-checkout">
            <div class="page-order-checkout-wrap">
                <div class="b1 icon_arrow" onclick="location.href='/address'">
                    @if($address)
                        <div class="b11">
                            <p>
                                <span>{{$address->name}}</span>
                                <span id="tel">{{$address->tel}}</span>
                            </p>
                        </div>
                        <div class="b13">
                            <p id="address" data-id="{{$address->id or ''}}">
                                {{$address->province or ''}} {{$address->city or ''}} {{$address->area or ''}}
                                {{$address->address or ''}}
                            </p>
                        </div>
                    @else
                        <div class="b11">
                            <p>
                                <span>没有收获地址!</span>
                            </p>
                        </div>
                        <div class="b13">
                            <p id="address" data-id="">
                                <span style="color: #ff5722">来,请先填写一个收获地址</span>
                            </p>
                        </div>
                    @endif
                </div>
                <div class="ui_line"></div>
                <div class="b2">
                    <ul id="ul" class="">

                        <li class="li on" data-id="1">
                            <a href="javascript:void(0);" class="wechatpay">
                                <input type="hidden">微信支付
                            </a>
                        </li>
                        <li class="li" data-id="2">
                            <a href="javascript:void(0);" class="micash_wap">
                                <input type="hidden">小米钱包
                            </a>
                        </li>
                        <li class="li" data-id="3">
                            <a href="javascript:void(0);" class="unionpaywap">
                                <input type="hidden">银联在线支付
                            </a>
                        </li>
                        <li class="li" data-id="4">
                            <a href="javascript:void(0);" class="alipaywap">
                                <input type="hidden">支付宝
                            </a>
                        </li>
                        <li class="li" data-id="5">
                            <a href="javascript:void(0);" class="bestpay_wap">
                                <input type="hidden">翼支付
                            </a>
                        </li>
                        <li class="li" data-id="6">
                            <a href="javascript:void(0);" class="">
                                <input type="hidden">货到付款
                            </a>
                        </li>
                    </ul>
                    {{--<div class="kui" id="guan"><p>收起其他支付方式</p></div>--}}
                </div>

                <div class="ui_line"></div>


                {{--<div class="b3 icon_arrow">--}}
                {{--<dl>--}}
                {{--<dt><span>电子发票</span><strong>发票类型</strong></dt>--}}
                {{--</dl>--}}
                {{--</div>--}}
                {{--<div class="b3 icon_arrow">--}}
                {{--<dl>--}}
                {{--<dt><span>不限送货时间</span><strong>送货时间</strong></dt>--}}
                {{--</dl>--}}
                {{--</div>--}}
                {{--<div class="ui_line"></div>--}}

                <div class="b8">
                    @foreach($carts as $care)
                        @if($care->num != 0)
                            <div class="b8w">
                                <div class="b81">
                                    <div class="img"><img src="{{$care->product->image}}?width=80&amp;height=80">
                                    </div>
                                </div>
                                <div class="b82">
                                    <div class="name"><p>
                                            <span>{{$care->product->name}}</span>
                                        </p>
                                    </div>
                                </div>
                                <div class="b83">
                                    <div class="price">
                                        @if($care->num > 1)
                                            <span>{{doubleval($care->product->price)}} × {{$care->num}} = </span>
                                        @endif
                                        <strong>{{doubleval($care->product->price)*$care->num}} 元</strong>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                    <div class="ui_line"></div>
                    <div class="b5">
                        <div class="b51">
                            <p>
                                <strong>商品价格：</strong>
                                <span>{{$count['total_price']}}元</span>
                            </p>
                        </div>
                        <div class="b53">
                            <p>
                                <strong>配送费用：</strong>
                                <span>0元</span>
                            </p>
                        </div>
                    </div>
                    <div class="b7">
                        <div class="b71">
                            <span>共{{$count['num']}}件 合计: </span>
                            <strong>{{$count['total_price']}}元</strong>
                        </div>
                        <div class="b72">
                            <a href="javascript:void(0);" class="ui-button" id="pay">
                                <span>去付款</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
@section('js')
    <script>
        $(function () {
            var tel = $('#tel').text();
            var phone = tel.substr(0, 3) + '****' + tel.substr(7);
            $('#tel').text(phone);


            $('.li').click(function () {
                $(this).addClass('on').siblings().removeClass('on');
            });

//            $('.kui').click(function () {
////                alert(213);
//                $(this).siblings('#ul').addClass('payment-fold');
//                $(this).find('span').removeClass('unfold');
//                $(this).find("p").replaceWith("<p>使用其他支付方式</p>");        //替换节点
//            });
//
//            $('#guan').click(function () {
//                $(this).siblings('#ul').removeClass('payment-fold');
//                $(this).find('span').addClass('unfold');
//                $(this).find('p').replaceWith('<p>收起其他支付方式</p>');
//            });


            $('#pay').click(function () {
//                console.log(pay);
                var info = {
                    address_id: $('#address').data('id'),
                    pay: $('.on').data('id')
                };
                if (info.address_id == '') {
                    alert('请先填写一个地址');
                    return false;
                }
                $.ajax({
                    type: 'POST',
                    url: '/order/store',
                    data: info,
//                    dataType: 'json',
                    success: function (data) {
//                        console.log(data);
                        if (data.status == '0') {
                            if (data.info != '') {
                                alert(data.info);
                            }
                            window.location.href = '/cart';
                            return false;
                        }

                        alert('可以再订单里面假支付');
                        window.location.href = '/';
                        //微信支付
//                        location.href = '/order/pay/' + data.order_id;
                    }
                });
            })
            ;
        })
    </script>
@endsection