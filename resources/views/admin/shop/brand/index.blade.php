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
            color: #0000ff;

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
                <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">商品品牌</strong> /
                    <small>Brand Brands</small>
                </div>
            </div>
            @include('layouts.admin._flash')
            <div class="am-g">
                <div class="am-u-sm-12 am-u-md-6">
                    <div class="am-btn-toolbar">
                        <div class="am-btn-group am-btn-group-xs">
                            <a href="{{route('shop.brand.create')}}" class="am-btn am-btn-default"><span
                                        class="am-icon-plus"></span> 新 增
                            </a>
                        </div>
                    </div>
                </div>
                <form>
                    <div class="am-u-sm-12 am-u-md-3" style="margin-left: 300px;">
                        <div class="am-input-group am-input-group-sm">
                            <input type="text" name="keyword" class="am-form-field"
                                   value="{{Request::input('keyword')}}">
                            <span class="am-input-group-btn">
                            <button class="am-btn am-btn-default" type="submit">搜 索</button>
                            <a class="am-btn am-btn-default" href="{{route('shop.brand.index')}}">重 置</a>
                        </span>
                        </div>
                    </div>
                </form>
            </div>
            <div class="am-g">
                <div class="am-u-sm-12">
                    <table class="am-table am-table-bd am-table-striped admin-content-table">
                        <thead>
                        <tr>
                            <th class="table-id">ID</th>
                            <th class="table-title">名称</th>
                            <th class="table-thumb">缩略图</th>
                            <th class="table-title">品牌商品</th>
                            <th class="table-title">品牌地址</th>
                            <th class="table-author am-hide-sm-only">是否显示</th>
                            <th class="table-date am-hide-sm-only">排序</th>
                            <th class="table-set">操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($brands as $brand)
                            <tr data-id="{{$brand->id}}">
                                <td>{{$brand->id}}</td>
                                <td>{{$brand->name}}</td>
                                <td><img width="40px;" height="40px;" src="{{$brand->image}}"></td>
                                <td>
                                    {{--<a class="am-btn am-btn-success am-btn-xs">查看商品</a>--}}
                                    {!! show_brand_products($brand) !!}
                                </td>
                                <td id="url"><a href="{{$brand->url}}" target="_blank">{{$brand->url}}</a></td>
                                <td>
                                    {!! is_something($brand,'is_show') !!}
                                </td>
                                <td>
                                    <input type="text" class="sort_order" value="{{$brand->sort_order}}"
                                           style="width: 70px;">
                                </td>
                                <td>
                                    <div class="am-btn-toolbar">
                                        <div class="am-btn-group am-btn-group-xs">
                                            <a style="color:#1006F1"
                                               class="am-btn am-btn-default am-btn-xs am-text-secondary"
                                               href="{{route('shop.brand.edit',$brand->id)}}"><span
                                                        class="am-icon-pencil-square-o"></span> 编辑
                                            </a>
                                            <a style=" color:#ff0000;" href="{{route('shop.brand.destroy',$brand->id)}}"
                                               data-method="delete"
                                               data-token="{{csrf_token()}}" data-confirm="确认删除吗?"
                                               class=" am-btn am-btn-default am-btn-xs am-text-danger am-hide-sm-only">
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
                        注 : 共 {{$brands->total()}} 条记录
                        <div class="am-fr all">
                            {{ $brands->links() }}
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
    <script src="/js/shop/brand.js"></script>
@endsection

