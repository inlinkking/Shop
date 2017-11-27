@extends('layouts.admin.application')
@section('css')
    <link rel="stylesheet" href="/vendor/daterangepicker/daterangepicker.css">
    <style>
        .daterangepicker {
            display: none;
        }
    </style>
@endsection
@section('content')
    <div class="admin-content">
        <div class="admin-content-body">
            <div class="am-cf am-padding">
                <div class="am-fl am-cf">
                    <strong class="am-text-primary am-text-lg">订单管理</strong> /
                    <small>Order Manage</small>
                </div>
            </div>
            <hr/>
            @include('layouts.admin._flash')
            <div class="am-g">
                <div class="am-u-sm-12 am-u-md-12">
                    <form class="am-form-inline" role="form" method="get">

                        <div class="am-form-group">
                            <input type="text" name="id" class="am-form-field am-input-sm" placeholder="订单号"
                                   value="{{Request::input('id')}}">
                        </div>

                        <div class="am-form-group">
                            <input type="text" name="user_id" class="am-form-field am-input-sm" placeholder="会员编号"
                                   value="{{Request::input('user_id')}}">
                        </div>

                        <div class="am-form-group">
                            <input type="text" name="total_price" class="am-form-field am-input-sm"
                                   placeholder="订单金额(eg:>100)"
                                   value="{{Request::input('total_price')}}">
                        </div>

                        <div class="am-form-group">
                            <select data-am-selected="{btnSize: 'sm', maxHeight: 360, searchBox: 1}" name="status">
                                <option value="-1">订单状态</option>
                                @foreach($order_status as $key=>$value)
                                    <option value="{{ $key }}" @if($key == Request::input('status'))
                                    selected @endif>{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="am-form-group">
                            <input type="text" id="created_at" placeholder="选择下单时间" name="created_at"
                                   value="{{Request::input('created_at')}}"
                                   class="am-form-field am-input-sm">
                        </div>

                        <button type="submit" class="am-btn am-btn-default am-btn-sm">查询</button>
                        <a href="{{route('shop.order.index')}}" class="am-btn am-btn-default am-btn-sm">重 置</a>
                    </form>
                </div>
            </div>
            <div class="am-g">
                <div class="am-u-sm-12">
                    <div class="order-list-box">
                        <ul class="order-list">
                            @foreach ($orders as $order)
                                <li class="uc-order-item {{order_color($order->status)}}">
                                    <div class="order-detail">
                                        <div class="order-summary">
                                            <div class="order-status">{{order_status($order->status)}}</div>
                                        </div>
                                        <table class="order-detail-table">
                                            <thead>
                                            <tr>
                                                <th class="col-main">
                                                    <p class="caption-info">{{$order->created_at}}
                                                        <span class="sep">|</span>
                                                        {{$order->address->name}}
                                                        (<a href="javascript:void(0);">{{$order->address->tel}}</a>)
                                                        <span class="sep">|</span>
                                                        订单号：<a href="javascript:void(0);">{{$order->id}}</a>
                                                        {{--<span class="sep">|</span>在线支付--}}
                                                    </p>
                                                </th>
                                                <th class="col-sub">
                                                    <p class="caption-price">订单金额：
                                                        <span class="num">{{doubleval($order->total_price)}}</span>元
                                                    </p>
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td class="order-items">
                                                    <ul class="goods-list">
                                                        @foreach($order->order_products as $order_product)
                                                            <li>
                                                                <div class="figure figure-thumb">
                                                                    <a href="{{$order_product->product->image}}"
                                                                       target="_blank">
                                                                        <img src="{{$order_product->product->image}}"
                                                                             alt="{{$order_product->product->name}}"
                                                                             width="80px;" height="80px;">
                                                                    </a>
                                                                </div>
                                                                <p class="name">
                                                                    <a href="javascript:void(0);" target="_blank">
                                                                        {{$order_product->product->name}}</a>
                                                                </p>
                                                                <p class="price">
                                                                    {{doubleval($order_product->product->price)}}
                                                                    元
                                                                    ×
                                                                    {{$order_product->num}}</p>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </td>
                                                <td class="order-actions">
                                                    <a class="btn btn-small btn-line-gray"
                                                       href="{{route('shop.order.show',$order->id)}}">订单详情</a>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    共 {{$orders->total()}} 条记录

                    <div class="am-cf">
                        <div class="am-fr">
                            {!! $orders->links() !!}
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <footer class="admin-content-footer">
            <hr>
            <p class="am-padding-left">© 2017 my-xieqing Inc. Licensed under MIT license.</p>
        </footer>
    </div>
@endsection
@section('js')
    <script src="/vendor/daterangepicker/moment.js"></script>
    <script src="/vendor/moment/locale/zh-cn.js"></script>
    <script src="/vendor/daterangepicker/daterangepicker.js"></script>
    <script src="/js/daterange_config.js"></script>
@endsection
