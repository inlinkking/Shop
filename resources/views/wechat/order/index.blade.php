@extends('layouts.wechat.application')

@section('content')
    <div class="header">
        <div class="left">
            <img src="http://s1.mi.com/m/images/m/icon_back_n.png" class="ib" border="0"
                 onclick="javascript:history.back(-1);" title="返回上一页">
        </div>
        <div class="tit"><h2 data-log="HEAD-标题-我的订单"><span class="title">我的订单</span></h2></div>
        <div class="right">
            <a href="/">
                <div class="icon icon-home"></div>
            </a>
        </div>
    </div>
    <div class="cart-index" id="more" @if (!$orders->isEmpty()) style="display: none;" @endif>
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
    <div class="page-my-order" data-log="我的订单" @if ($orders->isEmpty()) style="display: none;" @endif>
        <div class="order_list">
            @foreach($orders as $order)
                <div class="ol-item">
                    <div>
                        <div class="oi1">
                            <div class="oi11">
                                <div class="oi111">
                                    <p>
                                        <strong>订单日期：</strong>
                                        <span>{{$order->created_at}}</span>
                                    </p>
                                </div>
                                <div class="oi112">
                                    <p>
                                        <strong>订单编号：</strong>
                                        <span>{{$order->id}}</span>
                                    </p>
                                </div>
                            </div>
                            <div class="oi12">
                                <p>{{$order_status["$order->status"]}}</p>
                            </div>
                        </div>
                        <div class="oi2" onclick="location.href='/order/show/{{$order->id}}'">
                            <ul>
                                @foreach($order->order_products as $order_product)
                                    <li>
                                        <div class="oi21">
                                            <div class="img">
                                                <img src="{{$order_product->product->image}}">
                                            </div>
                                        </div>
                                        <div class="oi22">
                                            <p>{{$order_product->product->name}}</p>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="oi3">
                            <p>
                                <span>共{{count($order->order_products)}}件商品</span>
                                <span>总金额：</span>
                                <strong>{{doubleval($order->total_price)}}元</strong>
                            </p>
                        </div>
                        @if($order->status == '1')
                            <div class="oi4" data-id="{{$order->id}}">
                                <a href="/order/pay/{{$order->id}}" class="org">立即付款</a>
                                <a class="delete" href="javascript:void(0);">取消订单</a>
                            </div>
                        @endif
                        @if($order->status == '4')
                            <div class="oi4" data-id="{{$order->id}}">
                                <a href="javascript:void(0);" id="delete_all" class="org">确认收货</a>
                                <a class="delete" href="javascript:void(0);">取消收货</a>
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
        @include('layouts.wechat._headr')
    </div>
@endsection
@section('js')
    <script>
        $('.delete').click(function () {
            var id = $(this).parents('div').data('id');
            var _this = $(this);
            $.ajax({
                type: 'DELETE',
                url: '/order/destroy/' + id,
                data: {id: id},
                success: function () {
//                    console.log(data);
//                    return false;
                    _this.parents('.ol-item').fadeOut(500);
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