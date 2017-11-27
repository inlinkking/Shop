@extends('layouts.admin.application')
@section('css')
    <link rel="stylesheet" href="/vendor/daterangepicker/daterangepicker.css">
    <style>
        .thumb {
            max-height: 60px;
        }
    </style>
@endsection
@section('content')
    <div class="admin-content">

        <div class="am-cf am-padding">
            <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">订单详情</strong> /
                <small>Order Detail</small>
            </div>
        </div>

        @include('layouts.admin._flash')

        <div class="am-g">
            <div class="am-u-sm-12">
                <div class="uc-box uc-main-box">
                    <div class="uc-content-box order-view-box">
                        <div class="box-hd">
                            <h1 class="title">订单详情
                                <small>请谨防钓鱼链接或诈骗电话</small>
                            </h1>
                            <div class="more clearfix">
                                <h2 class="subtitle">订单号：
                                    <span class="tag tag-subsidy">{{$order->id}}</span>
                                </h2>
                            </div>
                        </div>
                        <div class="box-bd">
                            <div class="uc-order-item uc-order-item-finish">
                                <div class="order-detail">
                                    <div class="order-summary">
                                        <div class="order-status">
                                            {{order_status($order->status)}}
                                            <div style="float:right;margin-right:10px;" data-id="{{$order->id}}">
                                                {{--配货--}}
                                                @if($order->status == 2)
                                                    <a class="am-btn am-btn-secondary am-radius"
                                                       id="picking">配货</a>
                                                @endif

                                                {{--发货--}}
                                                @if(in_array($order->status,[3,4]))
                                                    <form style="display: inline-block"
                                                          class="am-form-inline">

                                                        <div class="am-form-group">
                                                            <select data-am-selected="{btnWidth: '100%',
                                                         btnStyle: 'secondary',  maxHeight: 360, searchBox: 1}"
                                                                    id="express_id">
                                                                @foreach($expresses as $express)
                                                                    <option value="{{$express->id}}"
                                                                            @if($order->express_id==$express->id)
                                                                            selected @endif>
                                                                        {{$express->name}}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="am-form-group">
                                                            <input type="text" class="am-form-field" id="express_code"
                                                                   value="{{$order->express_code}}">
                                                        </div>

                                                        <button type="button" class="am-btn am-btn-warning"
                                                                id="shipping" data-status="{{$order->status}}">
                                                            @if($order->status ==3)
                                                                发货
                                                            @endif
                                                            @if($order->status ==4)
                                                                修改快递信息
                                                            @endif
                                                        </button>
                                                        @if($order->status ==4)
                                                            <button type="button" class="am-btn am-btn-success"
                                                                    id="finish">
                                                                交易成功
                                                            </button>
                                                        @endif
                                                    </form>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="order-progress">
                                            <ol class="progress-list clearfix">
                                                <li class="step step-first step-done">
                                                    <div class="progress">
                                                        <span class="text">下单</span>
                                                    </div>
                                                    <div class="info">{{$order->created_at}}</div>
                                                </li>
                                                <li class="step @if($order->status >=2) step-done @endif">
                                                    <div class="progress">
                                                        <span class="text">付款</span>
                                                    </div>
                                                    <div class="info">{{$order->pay_time}}</div>
                                                </li>
                                                <li class="step @if($order->status >=3) step-done @endif">
                                                    <div class="progress">
                                                        <span class="text">配货</span>
                                                    </div>
                                                    <div class="info">{{$order->picking_time}}</div>
                                                </li>
                                                <li class="step @if($order->status >=4) step-done @endif">
                                                    <div class="progress">
                                                        <span class="text">出库</span>
                                                    </div>
                                                    <div class="info">{{$order->shipping_time}}</div>
                                                </li>
                                                <li class="step @if($order->status ==5) step-active @endif step-last">
                                                    <div class="progress">
                                                        <span class="text">交易成功</span>
                                                    </div>
                                                    <div class="info">{{$order->finish_time}}</div>
                                                </li>
                                            </ol>
                                        </div>


                                        {{--发货后才显示物流信息--}}
                                        @if($order->status >=4)
                                            <div class="order-delivery order-delivery-detail">
                                                <p class="delivery-num">
                                                    物流公司：
                                                    @if($order->status >= 4)
                                                        <a href="{{$order->express->url}}"
                                                           target="_blank">{{$order->express->name}}
                                                            <i class="iconfont am-icon-arrow-circle-o-right"></i>
                                                        </a>
                                                    @endif
                                                    运单号：
                                                    @if($order->status >= 4)
                                                        {{$order->express_code}}
                                                    @endif
                                                </p>
                                                <div class="delivery-list-wrapper">
                                                    <iframe src="http://m.kuaidi100.com/index_all.html?
                                                    type={{$order->express->code}}&postid={{$order->express_code}}"
                                                            frameborder="0" width="100%" height="500"></iframe>
                                                    {{--@else--}}
                                                    {{--<ul class="delivery-list" data-deliver-list="115042635001301001">--}}
                                                    {{--<li class="empty">暂无物流信息。</li>--}}
                                                    {{--</ul>--}}
                                                </div>
                                            </div>
                                            <a class="order-delivery-trigger J_deliveryTrigger has-result toggled"
                                               href="javascript: void(0);">展开物流详情
                                                <i class="iconfont am-icon-angle-down"></i>
                                            </a>
                                        @endif
                                    </div>
                                    <table class="order-items-table">
                                        <tbody>
                                        @foreach($order->order_products as $order_product)
                                            <tr>
                                                <td class="col col-thumb">
                                                    <div class="figure figure-thumb">
                                                        <a target="_blank"
                                                           href="{{$order_product->product->image}}">
                                                            <img src="{{$order_product->product->image}}"
                                                                 alt="{{$order_product->product->name}}"
                                                                 width="80px;" height="80px;">
                                                        </a>
                                                    </div>
                                                </td>
                                                <td class="col col-name">
                                                    <p class="name">
                                                        <a target="_blank"
                                                           href="javascript:void(0);">{{$order_product->product->name}}</a>
                                                    </p>
                                                </td>
                                                <td class="col col-price">
                                                    <p class="price">
                                                        {{doubleval($order_product->product->price)}}元
                                                        × {{$order_product->num}}
                                                    </p>
                                                </td>
                                                <td class="col col-actions">
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div id="editAddr" class="order-detail-info">

                                    <h3>收货信息</h3>
                                    <table class="info-table">
                                        <tbody>
                                        <tr>
                                            <th>客户编号：</th>
                                            <td>{{$order->user->id}}</td>
                                        </tr>
                                        <tr>
                                            <th>姓&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;名：</th>
                                            <td>{{$order->address->name}}</td>
                                        </tr>
                                        <tr>
                                            <th>联系电话：</th>
                                            <td>{{$order->address->tel}}</td>
                                        </tr>
                                        <tr>
                                            <th>收货地址：</th>
                                            <td>
                                                {{$order->address->province}}
                                                {{$order->address->city}}
                                                {{$order->address->area}}
                                                {{$order->address->address}}
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <div class="actions">
                                    </div>
                                </div>


                                <div id="editTime" class="order-detail-info">
                                    <h3>支付方式及送货时间</h3>
                                    <table class="info-table">
                                        <tbody>
                                        <tr>
                                            <th>支付方式：</th>
                                            <td>
                                                @if($order->pay_type == 1)
                                                    微信支付
                                                @elseif($order->pay_type == 2)
                                                    小米钱包
                                                @elseif($order->pay_type == 3)
                                                    银联在线支付
                                                @elseif($order->pay_type == 4)
                                                    支付宝
                                                @elseif($order->pay_type == 5)
                                                    翼支付
                                                @elseif($order->pay_type == 6)
                                                    货到付款
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>送货时间：</th>
                                            <td>不限送货时间</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <div class="actions">
                                    </div>
                                </div>
                                <!--
                                <div class="order-detail-info">
                                    <h3>发票信息</h3>
                                    <table class="info-table">
                                        <tbody><tr>
                                            <th>发票类型：</th>
                                            <td>单位纸质发票</td>
                                        </tr>
                                        <tr>
                                            <th>发票内容：</th>
                                            <td>购买商品明细</td>
                                        </tr>
                                        <tr>
                                            <th>发票抬头：</th>
                                            <td>武汉长乐未央网络科技有限公司</td>
                                        </tr>
                                        </tbody></table>
                                    <div class="actions">
                                    </div>
                                </div>
                                -->

                                <div class="order-detail-total">
                                    <table class="total-table">
                                        <tbody>
                                        <tr>
                                            <th>商品总价：</th>
                                            <td>
                                                <span class="num">{{doubleval($order->total_price)}}</span>元
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>运&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;费：</th>
                                            <td>
                                                <span class="num">{{doubleval($order->express_money)}}</span>元
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>订单金额：</th>
                                            <td>
                                                <span class="num">
                                                    {{doubleval($order->total_price + $order->express_money)}}</span>元
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="total">实付金额：</th>
                                            <td class="total">
                                                @if($order->status == '1')
                                                    <span class="num">
                                                        0元
                                                    </span>
                                                @else
                                                    <span class="num">
                                                        {{doubleval($order->total_price + $order->express_money)
                                                        }}元
                                                    </span>
                                                @endif
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="/js/shop/order.js"></script>
@endsection
