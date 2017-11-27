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
        .am-icon-check {
            color: #00ff7f;
        }

        .am-icon-remove {
            color: #ff0000;
        }

        .am-icon-check, .am-icon-remove {
            cursor: pointer;
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
                <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">商品管理</strong> /
                    <small>Product Brands</small>
                </div>
            </div>
            @include('layouts.admin._flash')
            <div class="am-g" style="height: 37px;">
                <div class="am-u-sm-12 am-u-md-6">
                    <div class="am-btn-toolbar">
                        <div class="am-btn-group am-btn-group-xs">
                            <a href="{{route('shop.product.create')}}" class="am-btn am-btn-default"><span
                                        class="am-icon-plus"></span> 新 增
                            </a>
                            <a href="javascript:void(0);" id="del_more" class="am-btn am-btn-default"><span
                                        class="am-icon-trash-o"></span> 删 除
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <hr>
            <div class="am-g">
                <div class="am-u-sm-12 am-u-md-12">
                    <form class="am-form-inline" role="form" method="get">

                        <div class="am-form-group">
                            <input type="text" name="name" class="am-form-field am-input-sm" placeholder="商品名"
                                   value="{{Request::input('name')}}">
                        </div>

                        <div class="am-form-group">
                            <select data-am-selected="{btnSize: 'sm', maxHeight: 360, searchBox: 1}" name="category_id">
                                <optgroup label="请选择">
                                    <option value="-1">所有分类</option>
                                </optgroup>
                                @foreach($filter_categories as $category)
                                    <optgroup label="{{$category->name}}">
                                        @foreach($category->children as $child)
                                            <option value="{{$child->id}}"
                                                    @if($child->id == Request::input('category_id'))
                                                    selected @endif>{{$child->name}}</option>
                                        @endforeach
                                    </optgroup>
                                @endforeach
                            </select>
                        </div>

                        <div class="am-form-group">
                            <select data-am-selected="{btnSize: 'sm', maxHeight: 360, searchBox: 1}" name="brand_id">
                                <option value="-1">所有品牌</option>
                                @foreach($brands as $brand)
                                    <option value="{{$brand->id}}"
                                            @if($brand->id==Request::input('brand_id'))
                                            selected @endif>{{$brand->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="am-form-group">
                            <input type="text" id="created_at" placeholder="选择时间日期" name="created_at"
                                   value="{{Request::input('created_at')}}"
                                   class="am-form-field am-input-sm">
                        </div>

                        <div class="am-form-group">
                            <select data-am-selected="{btnSize: 'sm'}" name="is_shelves" id="" style="display: none;">
                                <option value="-1" @if(Request::input('is_shelves')=='-1') selected @endif>上架状态</option>
                                <option value="1" @if(Request::input('is_shelves')=='1') selected @endif>上架</option>
                                <option value="0" @if(Request::input('is_shelves')=='0') selected @endif>下架</option>
                            </select>
                        </div>

                        <button type="submit" class="am-btn am-btn-default am-btn-sm">查询</button>
                        <a href="{{route('shop.product.index')}}" class="am-btn am-btn-default am-btn-sm">重 置</a>
                    </form>
                </div>
            </div>
            <form>
                <div class="am-g">
                    <div class="am-u-sm-12">
                        <table class="am-table am-table-bd am-table-striped admin-content-table">
                            <thead>
                            <tr>
                                <th><input type="checkbox" id="checkAll" class="ace"></th>
                                <th>ID</th>
                                <th>缩略图</th>
                                <th>名称</th>
                                <th>所属分类</th>
                                <th>品牌</th>
                                <th>单价</th>
                                <th>上架</th>
                                <th>置顶</th>
                                <th>推荐</th>
                                <th>热销</th>
                                <th>新品</th>
                                <th>库存</th>
                                <th>上架日期</th>
                                <th class="table-set">操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($products as $product)
                                <tr data-id="{{$product->id}}">
                                    <td><input type="checkbox" name="id[]" value="{{$product->id}}"
                                               class=" checkOne checked_id">
                                    </td>
                                    <td>{{$product->id}}</td>
                                    <td><img width="40px;" height="40px;" src="{{$product->image}}"></td>
                                    <td style="width: 120px;">{{$product->name}}</td>
                                    <td>{{$product->categories->implode('name',",")}}</td>
                                    <td>{{$product->brand->name or ''}}</td>
                                    <td>￥{{$product->price}}</td>
                                    @foreach(array('is_shelves','is_top','is_recommend'
                                    ,'is_selling','is_new') as $attr)
                                        <td>{!! is_something($product,$attr) !!}</td>
                                    @endforeach
                                    <td>
                                        <input type="text" class="stock" value="{{$product->stock}}"
                                               style="width: 70px;">
                                    </td>
                                    <td>{{$product->created_at}}</td>
                                    <td>
                                        <div class="am-btn-toolbar">
                                            <div class="am-btn-group am-btn-group-xs">
                                                <a style="color:#1006F1"
                                                   class="am-btn am-btn-default am-btn-xs am-text-secondary"
                                                   href="{{route('shop.product.edit',$product->id)}}"><span
                                                            class="am-icon-pencil-square-o"></span> 编辑
                                                </a>
                                                <a style=" color:#ff0000;"
                                                   href="{{route('shop.product.destroy',$product->id)}}"
                                                   data-method="delete"
                                                   data-token="{{csrf_token()}}" data-confirm="确认删除吗?"
                                                   class="am-btn am-btn-default am-btn-xs
                                                   am-text-danger am-hide-sm-only">
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
                            注 : 共 {{$products->total()}} 条记录
                            <div class="am-fr all">
                                {{ $products->links() }}
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
    <script src="/js/shop/product.js"></script>
@endsection



