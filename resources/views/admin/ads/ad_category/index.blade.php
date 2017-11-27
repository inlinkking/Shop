@extends('layouts.admin.application')
@section('content')
    <div class="admin-content">
        <div class="admin-content-body">
            <div class="am-cf am-padding am-padding-bottom-0">
                <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">广告分类</strong> /
                    <small>Ads Ad_category</small>
                </div>
            </div>
            <hr>
            @include('layouts.admin._flash')
            <div class="am-g">
                <div class="am-u-sm-12 am-u-md-6">
                    <div class="am-btn-toolbar">
                        <div class="am-btn-group am-btn-group-xs">
                            <button type="button" id="xin" class="am-btn am-btn-default"><a
                                        href="{{route('ads.ad_category.create')}}"><span
                                            class="am-icon-plus"></span>新增</a>
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
                            <th class="table-date">排序</th>
                            <th class="table-set">操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($ad_category as $category)
                            <tr class="xParent parent" id="row_{{$category->id}}" data-id="{{$category->id}}">
                                <td>{{$category->id}}</td>
                                <td>
                                    @if($category->image)<img src="{{$category->image}}" width="40px;" height="40px;">
                                    @endif
                                </td>
                                <td>{{$category->name}}</td>
                                <td class="am-hide-sm-only ">
                                    <input type="text" style="width: 50px;height: 30px;" class="sort_order"
                                           value="{{$category->sort_order}}"></td>
                                <td>
                                    <div class="am-btn-toolbar">
                                        <div class="am-btn-group am-btn-group-xs">
                                            <a style="background-color: #fff;color:#1006f1;"
                                               href="{{route('ads.ad_category.edit',$category->id)}}"
                                               class="am-btn am-btn-default am-btn-xs am-text-secondary"><span
                                                        class="am-icon-pencil-square-o"></span> 编辑
                                            </a>
                                            <a style="background-color: #fff; color:#dd514c;"
                                               href="{{route('ads.ad_category.destroy', $category->id)}}"
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
                        </tbody>
                    </table>
                    <div class="am-cf">
                        注 : 共 {{$ad_category->count()}} 条分类
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
    <script src="/js/ads/ad_category.js"></script>
@endsection