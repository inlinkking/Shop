{{--/**--}}
{{--* Created by PhpStorm.--}}
{{--* User: xieqi--}}
{{--* Date: 2017/9/7--}}
{{--* Time: 14:47--}}
{{--*/--}}

@extends('layouts.admin.application')
@section('css')
    <style>
        .am-icon-check {
            color: #00ff7f;
        }

        .am-icon-remove {
            color: #ff0000;
        }

        #url a {
            color: #0e90d2;

        }

        .am-icon-check, .am-icon-remove {
            cursor: pointer;
        }
    </style>
@endsection
@section('content')
    <!-- content start -->
    <div class="admin-content">
        <div class="admin-content-body">
            <div class="am-cf am-padding">
                <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">物流运费</strong> /
                    <small>Express Manage</small>
                </div>
            </div>
            @include('layouts.admin._flash')
            <div class="am-g">
                <div class="am-u-sm-12 am-u-md-6">
                    <div class="am-btn-toolbar">
                        <div class="am-btn-group am-btn-group-xs">
                            <a href="{{route('shop.express.create')}}" class="am-btn am-btn-default"><span
                                        class="am-icon-plus"></span> 新 增
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="am-g">
                <div class="am-u-sm-12">
                    <table class="am-table am-table-bd am-table-striped admin-content-table">
                        <thead>
                        <tr>
                            <th>编号</th>
                            <th>物流名称</th>
                            <th>配送方式描述</th>
                            <th>运费/满额包邮</th>
                            <th>是否可用</th>
                            <th>排序</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($express as $expre)
                            <tr data-id="{{$expre->id}}">
                                <td>{{$expre->id}}</td>
                                <td id="url"><a href="{{$expre->url}}" target="_blank">{{$expre->name}}</a></td>
                                <td>{{$expre->description}}</td>
                                <td>{{$expre->shipping_money}}/{{$expre->shipping_free}}</td>
                                <td>
                                    {!! is_something($expre,'is_enable') !!}
                                </td>
                                <td>
                                    <input type="text" class="sort_order" value="{{$expre->sort_order}}"
                                           style="width: 70px;">
                                </td>
                                <td>
                                    <div class="am-btn-toolbar">
                                        <div class="am-btn-group am-btn-group-xs">
                                            <a style="color:#1006F1"
                                               class="am-btn am-btn-default am-btn-xs am-text-secondary"
                                               href="{{route('shop.express.edit',$expre->id)}}"><span
                                                        class="am-icon-pencil-square-o"></span> 编辑
                                            </a>
                                            <a style=" color:#ff0000;"
                                               href="{{route('shop.express.destroy',$expre->id)}}"
                                               data-method="delete" data-token="{{csrf_token()}}"
                                               data-confirm="确认删除吗?"
                                               class="am-btn am-btn-default am-btn-xs am-text-danger am-hide-sm-only">
                                                <span class="am-icon-trash-o"></span> 删除
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="am-cf all">
                        注 : 共 {{$express->total()}} 条记录
                        <div class="am-fr all">
                            {{ $express->links() }}
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
    <script src="/js/shop/express.js"></script>
@endsection



