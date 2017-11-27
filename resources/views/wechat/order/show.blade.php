@extends('layouts.wechat.application')

@section('content')
    <div class="header">
        <div class="left">
            <img src="http://s1.mi.com/m/images/m/icon_back_n.png" class="ib" border="0"
                 onclick="javascript:history.back(-1);" title="返回上一页">
        </div>
        <div class="tit"><h2 data-log="HEAD-标题-订单详情"><span class="title">订单详情</span></h2></div>
        <div class="right">
            <a href="/">
                <div class="icon icon-home"></div>
            </a>
        </div>
    </div>
    <div class="page-order-view" data-log="订单详情">

        <div class="page-order-view-wrap">
            <div>
                <div class="b1">
                    <div class="b11">
                        <p>
                            <strong>订单编号：</strong>
                            <span>{{$order->id}}</span>
                        </p>
                    </div>
                    <div class="b11">
                        <p>
                            <strong>订单状态：</strong>
                            <span>{{order_status($order->status)}}</span>
                        </p>
                    </div>
                </div>
                <div class="ui_line"></div>
                <div class="b1">
                    <div class="b12">
                        <ul>
                            <li class="done">
                                <div class="mark">
                                    <p>下单</p>
                                </div>
                                <div class="time">
                                    <p>{{$order->created_at}}</p>
                                </div>
                            </li>
                            <li class="@if($order->status >=2) done @endif">
                                <div class="mark">
                                    <p>付款</p>
                                </div>
                                <div class="time">
                                    <p>{{$order->pay_time}}</p>
                                </div>
                            </li>
                            <li class="@if($order->status >= 3) done @endif">
                                <div class="mark">
                                    <p>配货</p>
                                </div>
                                <div class="time">
                                    <p>{{$order->picking_time}}</p>
                                </div>
                            </li>
                            <li class="@if($order->status >=4) done @endif">
                                <div class="mark">
                                    <p>出库</p>
                                </div>
                                <div class="time">
                                    <p>{{$order->shipping_time}}</p>
                                </div>
                            </li>
                            <li class="@if($order->status >= 5) done @endif">
                                <div class="mark">
                                    <p>交易成功</p>
                                </div>
                                <div class="time">
                                    <p>{{$order->finish_time}}</p>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="b8">
                    <div>
                        <div class="b81">
                            <p>
                                <strong>物流信息：</strong>
                                <span>{{$order->express->name or ''}}</span>
                                <span>{{$order->express_code or ''}}</span>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="ui_line"></div>
                <div class="b3">
                    <ul>
                        @foreach($order->order_products as $order_product)
                            <li>
                                <div class="ui-box">
                                    <div class="img">
                                        <img src="{{$order_product->product->image}}">
                                    </div>
                                    <div class="ui-box-flex">
                                        <div class="name">
                                            <p>{{$order_product->product->name}}</p>
                                        </div>
                                        <div class="price">
                                            <p>
                                                <strong>{{doubleval($order_product->product->price)
                                                 * $order_product->num}}元</strong>
                                                <span>售价：</span>
                                                <span>{{doubleval($order_product->product->price)}}元</span>
                                                <span>x{{$order_product->num}}</span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="ui_line"></div>
            </div>
            <div>
                <div class="b4">
                    <ul>
                        <li>
                            <strong>下单日期：</strong>
                            <span>{{$order->created_at}}</span>
                        </li>
                        <li class="address">
                            <div>
                                <strong>收货地址：</strong>
                            </div>
                            <div class="info">
                                <span>{{$order->address->province}}</span>
                                <span>{{$order->address->city}}</span>
                                <span>{{$order->address->area}}</span>
                                <span>{{$order->address->address}}</span>
                            </div>
                        </li>
                        <li>
                            <strong>收货人名：</strong>
                            <span>{{$order->address->name}} </span>
                            <span id="tel">{{$order->address->tel}}</span>
                        </li>
                        <!--<li><strong>收货时间：</strong><span>不限送货时间</span></li>-->
                        <!--<li><strong>发票类型：</strong><span>个人电子发票</span></li>-->
                        {{--<li><strong>发票抬头：</strong><span>个人</span></li>--}}
                    </ul>
                </div>
                <div class="ui_line"></div>
                <div class="b5">
                    <div class="b51">
                        <p>
                            <strong>商品价格：</strong>
                            <strong>{{doubleval($order->total_price)}}元</strong>
                        </p>
                    </div>
                    <div class="b51">
                        <p>
                            <strong>配送费用：</strong>
                            <strong>{{doubleval($order->express_money)}}元</strong>
                        </p>
                    </div>
                    <div class="b52">
                        <p>
                            <strong>应付总额：</strong>
                            <strong>{{doubleval($order->total_price+$order->express_money)}}元</strong>
                        </p>
                    </div>
                    @if($order->status != '1')
                        <div class="b52" style="margin-top: 5px;">
                            <p>
                                <strong>实际付款：</strong>
                                <strong>{{doubleval($order->total_price+$order->express_money)}}元</strong>
                            </p>
                        </div>
                        <div class="b51" style="margin-top: 5px;">
                            <p>
                                <strong>付款方式：</strong>
                                <strong>
                                    @if($order->pay_type == 1)
                                        微信支付
                                    @elseif($order->pay_type == 2)
                                        小米钱包支付
                                    @elseif($order->pay_type == 3)
                                        银联在线支付
                                    @elseif($order->pay_type == 4)
                                        支付宝支付
                                    @elseif($order->pay_type == 5)
                                        翼支付
                                    @elseif($order->pay_type == 6)
                                        货到付款
                                    @endif
                                </strong>
                            </p>
                        </div>
                    @endif
                </div>
                @if($order->status == '1')
                    <div class="b7">
                        <div class="ui-box">
                            <div class="ui-box-flex price">
                                <p>
                                    <span>应付总额：</span><br>
                                    <strong>{{doubleval($order->total_price+$order->express_money)}}元</strong>
                                </p>
                            </div>
                            <div class="ui-box-flex" data-id="{{$order->id}}">
                                <a id="delete" href="javascript:void(0);" class=" ui-button ui-button-gray">
                                    <span>取消订单</span>
                                </a>
                            </div>
                            <div class="ui-box-flex">
                                <a href="/order/pay/{{$order->id}}" class="ui-button">
                                    <span>立即支付</span>
                                </a>
                            </div>
                        </div>
                    </div>
                @endif
                @if($order->status == '4')
                    <div class="b7">
                        <div class="ui-box">
                            <div class="ui-box-flex" data-id="{{$order->id}}">
                                <a id="delete" href="javascript:void(0);" class="ui-button ui-button-gray">
                                    <span>取消收货</span>
                                </a>
                            </div>
                            <div class="ui-box-flex" data-id="{{$order->id}}">
                                <a id="delete_all" href="javascript:void(0);" class="ui-button">
                                    <span>确认收货</span>
                                </a>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        var tel = $('#tel').text();
        var phone = tel.substr(0, 3) + '****' + tel.substr(7);
        $('#tel').text(phone);
        $('#delete').click(function () {
            var id = $(this).parents('div').data('id');
            $.ajax({
                type: 'DELETE',
                url: '/order/destroy/' + id,
                data: {id: id},
                success: function () {
                    window.location.href = '/order';
                }
            })
        });
        $('#delete_all').click(function () {
            var id = $(this).parents('div').data('id');
//            console.log(id);
            $.ajax({
                type: 'PATCH',
                url: '/order/edit/' + id,
                data: {id: id},
                success: function () {
                    window.location.href = '/order';
                }
            });
        });
    </script>
@endsection
