@extends('layouts.admin.application')
@section('css')
    <style>
        #xin {
            background-color: #f1f4f5;
        }

        #show_all {
            background-color: #44b549;
            color: #ffffff;
        }

        #url a {
            color: #0000ff;
        }

        .am-icon-check {
            color: #00ff7f;
        }

        .am-icon-remove {
            color: #ff0000;
        }

        .am-icon-check, .am-icon-remove {
            cursor: pointer;
        }
    </style>
@endsection
@section('content')
    <div class="admin-content">
        <div class="admin-content-body">
            <div class="am-cf am-padding am-padding-bottom-0">
                <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">商品分类管理</strong> /
                    <small>Good Category Manage</small>
                </div>
            </div>
            <hr>
            @include('layouts.admin._flash')
            <div class="am-g">
                <div class="am-u-sm-12 am-u-md-6">
                    <div class="am-btn-toolbar">
                        <div class="am-btn-group am-btn-group-xs">
                            <button type="button" id="xin" class="am-btn am-btn-default"><a
                                        href="{{route('shop.category.create')}}"><span
                                            class="am-icon-plus"></span>新增</a>
                            </button>
                            <button type="button" id="show_all" class="am-btn am-btn-success"><span
                                        class="am-icon-arrows-alt"></span> 展开所有
                            </button>
                            <button type="button" id="hide_all" class="am-btn am-btn-secondary"><span
                                        class="am-icon-compress"></span> 折叠
                            </button>

                        </div>
                    </div>
                </div>
            </div>

            <div class="am-g">
                <div class="am-u-sm-12">
                    <table class="am-table am-table-striped am-table-hover table-main">
                        <thead>
                        <tr>
                            <th class="table-id">编号</th>
                            <th class="table-title">缩略图</th>
                            <th class="table-type" width="20%;">分类名</th>
                            <th class="table-author am-hide-sm-only" width="20%;">分类商品</th>
                            <th class="table-date am-hide-sm-only">是否显示</th>
                            <th class="table-date">排序</th>
                            <th class="table-set">操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($categories as $category)
                            <tr class="xParent parent" id="row_{{$category->id}}" data-id="{{$category->id}}">
                                <td>{{$category->id}}</td>
                                <td>
                                    @if($category->image)
                                        <img src="{{$category->image}}" width="40px;" height="40px;">
                                    @endif
                                </td>
                                <td>{{$category->name}}</td>
                                <td>
                                    {!! show_category_products($category) !!}
                                </td>
                                <td class="is_show">{!! is_something($category,'is_show') !!}</td>
                                <td class="am-hide-sm-only ">
                                    <input type="text" style="width: 50px;height: 30px;" class="sort_order"
                                           value="{{$category->sort_order}}"></td>
                                <td>
                                    <div class="am-btn-toolbar">
                                        <div class="am-btn-group am-btn-group-xs">
                                            <a style="background-color: #fff;color:#1006f1;"
                                               href="{{route('shop.category.edit',$category->id)}}"
                                               class="am-btn am-btn-default am-btn-xs am-text-secondary"><span
                                                        class="am-icon-pencil-square-o"></span> 编辑
                                            </a>
                                            <a style="background-color: #fff; color:#dd514c;"
                                               href="{{route('shop.category.destroy', $category->id)}}"
                                               data-method="delete"
                                               data-token="{{csrf_token()}}" data-confirm="确认删除吗?"
                                               class="am-btn am-btn-default am-btn-xs am-text-danger">
                                                <span class="am-icon-trash-o"></span> 删除
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @foreach($category->children as $child)
                                <tr class="xChildren child child_row_{{$category->id}}" style="display: none;"
                                    data-id="{{$child->id}}">
                                    <td>{{$child->id}}</td>
                                    <td><img src="{{$child->image}}" width="40px;" height="40px;"></td>
                                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$child->name}}</td>
                                    <td>
                                        {!! show_category_products($child) !!}
                                        {{--<a class="am-btn am-btn-success am-btn-xs">查看商品</a>--}}
                                    </td>
                                    <td class="show">{!! is_something($child,'is_show') !!}</td>
                                    <td class="am-hide-sm-only">
                                        <input type="text" style="width: 50px;height: 30px;" class="sort_order"
                                               value="{{$child->sort_order}}"></td>
                                    <td>
                                        <div class="am-btn-toolbar">
                                            <div class="am-btn-group am-btn-group-xs">
                                                <a href="{{route('shop.category.edit',$child->id)}}"
                                                   style="background-color: #fff;color:#1006f1;"
                                                   class="am-btn am-btn-default am-btn-xs am-text-secondary"><span
                                                            class="am-icon-pencil-square-o"></span> 编辑
                                                </a>
                                                <a style="background-color: #fff; color:#dd514c;"
                                                   href="{{route('shop.category.destroy', $child->id)}}"
                                                   data-method="delete"
                                                   data-token="{{csrf_token()}}" data-confirm="确认删除吗?"
                                                   class="am-btn am-btn-default am-btn-xs am-text-danger">
                                                    <span class="am-icon-trash-o"></span> 删除
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @endforeach
                        </tbody>
                    </table>
                    <div class="am-cf">
                        注 : {{$categories->count()}} 条大分类 ， 共 {{$category_num->count()}} 条记录
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
    <script src="/js/shop/category.js"></script>
@endsection