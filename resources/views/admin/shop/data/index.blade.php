@extends('layouts.admin.application')
@section('content')
    <!-- content start -->
    <div class="admin-content">
        <div class="admin-content-body">
            <div class="am-cf am-padding">
                <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">数据统计</strong> /
                    <small>Data Statistics</small>
                </div>
            </div>
            <hr/>
            @include('layouts.admin._flash')
            <ul class="am-avg-sm-1 am-avg-md-4 am-margin am-padding am-text-center admin-content-list ">
                <li><a href="{{route('shop.order.index')}}" class="am-text-success"><span
                                class="am-icon-btn am-icon-list-alt"></span><br/>订单管理<br/>
                        {{App\Models\Shop\Order::count()}}</a></li>
                <li><a href="{{route('shop.product.index')}}" class="am-text-warning"><span
                                class="am-icon-btn am-icon-calculator"></span><br/>商品管理<br/>
                        {{App\Models\Shop\Product::count()}}</a></li>
                <li><a href="{{route('shop.customer.index')}}" class="am-text-danger"><span
                                class="am-icon-btn am-icon-user"></span><br/>会员管理<br/>
                        {{App\User::where('is_show',0)->count()}}</a>
                </li>
                <li><a href="{{route('system.cache.store')}}" class="am-text-secondary" data-method="delete"
                       data-token="{{csrf_token()}}"
                       data-confirm="确认清除吗?"><span
                                class="am-icon-btn am-icon-refresh am-icon-spin"></span><br/>清除缓存</a></li>
            </ul>

            <hr data-am-widget="divider" style="" class="am-divider am-divider-default"/>

            <div class="am-g">
                <div class="am-u-sm-12">
                    <div id="sales_count" style="width: 100%;height:400px;"></div>
                </div>
            </div>

            <div class="am-g">

                <div class="am-u-sm-12">
                    <div id="sales_amount" style="width: 100%;height:400px;"></div>
                </div>
            </div>


            <hr data-am-widget="divider" style="" class="am-divider am-divider-default"/>


            <div class="am-g">
                <div class="am-u-sm-12">
                    <div id="top" style="width: 100%;height:600px;"></div>
                </div>
            </div>


            <div class="am-g">
                <div class="am-u-sm-6">
                    <div id="sex_count" style="height:600px;"></div>
                </div>

                <div class="am-u-sm-6">
                    <div id="customer_province" style="height:600px;"></div>
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
    <script type="text/javascript" src="/js/echarts.min.js"></script>
    <script type="text/javascript" src="/js/macarons.js"></script>
    <script src="/vendor/echarts/china.js"></script>
    <script src="/vendor/echarts/macarons.js"></script>
    <script src="/js/echarts/sex_count.js"></script>
    <script src="/js/echarts/customer_province.js"></script>
    <script src="/js/echarts/sales_count.js"></script>
    <script src="/js/echarts/sales_amount.js"></script>
    <script src="/js/echarts/top.js"></script>
@endsection
