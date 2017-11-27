{{--/**--}}
{{--* Created by PhpStorm.--}}
{{--* User: xieqi--}}
{{--* Date: 2017/9/7--}}
{{--* Time: 14:47--}}
{{--*/--}}

@extends('layouts.admin.application')
@section('css')
    <link rel="stylesheet" href="/vendor/daterangepicker/daterangepicker.css">
    <style>
        .am-icon-male {
            color: #3bb4f2;
        }

        .am-icon-female {
            color: #dd514c;
        }
        .thumb{
            width: 60px;
        }
        .daterangepicker {
            display: none;
        }
    </style>
@endsection
@section('content')
    <!-- content start -->
    <div class="admin-content">
        <div class="admin-content-body">
            <div class="am-cf am-padding">
                <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">会员管理</strong> /
                    <small>Customer Manage</small>
                </div>
            </div>
            @include('layouts.admin._flash')
            <div class="am-g">
                <div class="am-u-sm-12 am-u-md-12">
                    <form class="am-form-inline" role="form" method="get">

                        <div class="am-form-group">
                            <input type="text" name="nickname" class="am-form-field am-input-sm" placeholder="会员昵称"
                                   value="{{Request::input('nickname')}}">
                        </div>

                        <div class="am-form-group">
                            <input type="text" name="openid" class="am-form-field am-input-sm" placeholder="微信OPEN_ID"
                                   value="{{Request::input('openid')}}">
                        </div>

                        <div class="am-form-group">
                            <select data-am-selected="{btnSize: 'sm'}" name="sex" id="">
                                <option value="-1" @if(Request::input('sex')=='-1') selected @endif>选择性别</option>
                                <option value="1" @if(Request::input('sex')=='1') selected @endif>男</option>
                                <option value="2" @if(Request::input('sex')=='2') selected @endif>女</option>
                            </select>
                        </div>

                        <div class="am-form-group">
                            <input type="text" id="created_at" placeholder="选择注册时间" name="created_at"
                                   value="{{Request::input('created_at')}}"
                                   class="am-form-field am-input-sm">
                        </div>

                        <button type="submit" class="am-btn am-btn-default am-btn-sm">查询</button>
                        <a href="{{route('shop.customer.index')}}" class="am-btn am-btn-default am-btn-sm">重 置</a>
                    </form>
                </div>
            </div>
            <form>
                <div class="am-g">
                    <div class="am-u-sm-12">
                        <table class="am-table am-table-bd am-table-striped admin-content-table">
                            <thead>
                            <tr>
                                <th>编号</th>
                                <th>头像</th>
                                <th>昵称</th>
                                <th>openid</th>
                                <th>性别</th>
                                <th>关注时间</th>
                                <th class="table-set">操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($customers as $customer)
                                <tr>
                                    <td>{{$customer->id}}</td>
                                    <td><img src="{{$customer->headimgurl}}" class="thumb"></td>
                                    <td>{{$customer->nickname}}</td>
                                    <td>{{$customer->openid}}</td>
                                    <td class="am-hide-sm-only">
                                        @if($customer->sex == 1)
                                            <span class="am-icon-male"></span>
                                        @else
                                            <span class="am-icon-female"></span>
                                        @endif
                                    </td>

                                    <td>{{$customer->created_at}}</td>
                                    <td>
                                        <div class="am-btn-toolbar">
                                            <div class="am-btn-group am-btn-group-xs">
                                                <a href="/admin/shop/order/index?user_id={{$customer->id}}"
                                                   class="am-btn am-btn-default am-btn-xs
                                                   am-text-danger am-hide-sm-only delete">
                                                    <span class="am-icon-list-alt"></span> 查看订单
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="am-cf all">
                            注 : 共 {{$customers->total()}} 条记录
                            <div class="am-fr all">
                                {{ $customers->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </form>
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
