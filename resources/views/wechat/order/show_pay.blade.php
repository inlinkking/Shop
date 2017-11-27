@extends('layouts.wechat.application')
@section('content')
    <div class="header">
        <div class="left">
            <img src="http://s1.mi.com/m/images/m/icon_back_n.png" class="ib" border="0"
                 onclick="javascript:history.back(-1);" title="返回上一页">
        </div>
        <div class="tit">
            <h2 data-log="HEAD-标题-在线支付">
                <span class="title">在线支付</span>
            </h2>
        </div>
        <div class="right">
            <a href="/">
                <div class="icon icon-home"></div>
            </a>
        </div>
    </div>
    <div class="page-order-pay" data-log="在线支付">
        <div class="box box1">
            <div class="p1">
                <span class="icon-checked"></span>
                <span>订单提交成功</span>
            </div>
            {{--<div class="p2"><span>请在1小时57分43秒内完成支付，超时订单将关闭。</span></div>--}}
        </div>
        <div class="box box2">
            <div class="p">订单金额:
                {{$order->total_price + $order->express_money}}元
                &nbsp;&nbsp; 订单编号：{{$order->id}}
            </div>
            <div class="p h_box">
                <div>收货信息：</div>
                <div class="flex_1">
                    {{$order->address->name}}
                    <span id="tel">{{$order->address->tel}}</span>
                    <br>
                    {{$order->address->province}}  {{$order->address->city}}
                    {{$order->address->area}}  {{$order->address->address}}
                </div>
            </div>
            {{--<div class="p">发票类型：个人电子发票 <p>发票抬头：个人</p></div>--}}
        </div>
        <div class="box box3">
            <div class="head"><span>请选择支付方式</span></div>
            <div class="list">
                <div class="item active" data-id="1">
                    <div class="inner">
                        <div class="p">
                            <input type="hidden">微信
                        </div>
                    </div>
                </div>
                <div class="item" data-id="2">
                    <div class="inner">
                        <div class="p">
                            <input type="hidden">小米钱包
                        </div>
                        <div class="p right"></div>
                    </div>
                </div>
                <div class="item" data-id="3">
                    <div class="inner">
                        <div class="p">
                            <input type="hidden">银联在线支付
                        </div>
                        <div class="p right"></div>
                    </div>
                </div>
                <div class="item" data-id="4">
                    <div class="inner">
                        <div class="p">
                            <input type="hidden">支付宝
                        </div>
                    </div>
                </div>
                <div class="item" data-id="5">
                    <div class="inner">
                        <div class="p">
                            <input type="hidden">翼支付
                        </div>
                        <div class="p right"></div>
                    </div>
                </div>
                <div class="item" data-id="6">
                    <div class="inner">
                        <div class="p">
                            <input type="hidden">货到付款
                        </div>
                        <div class="p right"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="box box4">
            <div class="p p1">
                <p>本次需支付：
                    <span class="hot">{{$order->total_price +$order->express_money}}元</span>
                </p>
            </div>
        </div>
        <div class="box box5" data-id="{{$order->id}}">
            <a href="javascript:void(0);" data-log="bottom-bankgo" class="ui-button" id="pay">
                <span>立即支付</span>
            </a>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $(function () {
            var tel = $('#tel').text();
            var phone = tel.substr(0, 3) + '****' + tel.substr(7);
            $('#tel').text(phone);

            $('.item').click(function () {
                $(this).addClass('active').siblings().removeClass('active');
            });
            $('#pay').click(function () {
                var info = {
                    id: $('.box5').data('id'),
                    pay: $('.active').data('id')
                };
//                console.log(info);
                $.ajax({
                    type: 'PATCH',
                    url: '/order/update',
                    data: info,
                    success: function (data) {
                        alert('现在已经支付成功');
                        window.location.href = '/order';
                    }
                })

            })
        })
    </script>
@endsection