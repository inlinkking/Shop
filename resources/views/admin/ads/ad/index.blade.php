{{--/**--}}
{{--* Created by PhpStorm.--}}
{{--* User: xieqi--}}
{{--* Date: 2017/9/7--}}
{{--* Time: 14:47--}}
{{--*/--}}

@extends('layouts.admin.application')
@section('content')
    <!-- content start -->
    <div class="admin-content">
        <div class="admin-content-body">
            <div class="am-cf am-padding">
                <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">商品管理</strong> /
                    <small>Ad Brands</small>
                </div>
            </div>
            @include('layouts.admin._flash')
            <div class="am-g" style="height: 37px;">
                <div class="am-u-sm-12 am-u-md-6">
                    <div class="am-btn-toolbar">
                        <div class="am-btn-group am-btn-group-xs">
                            <a href="{{route('ads.ad.create')}}" class="am-btn am-btn-default"><span
                                        class="am-icon-plus"></span> 新 增
                            </a>
                            <a href="javascript:void(0);" id="del_more" class="am-btn am-btn-default"><span
                                        class="am-icon-trash-o"></span> 删 除
                            </a>
                        </div>
                    </div>
                </div>
                <div class="am-u-sm-12 am-u-md-3">
                    <div class="am-form-group">
                        <select data-am-selected="{btnWidth: '80%',  btnStyle: 'secondary', btnSize: 'sm',
                        maxHeight: 360, searchBox: 1}"
                                name="category_id" id="change_category">
                            <option value="-1">所有分类</option>
                            @foreach($categories as $category)
                                <option value="{{$category->id}}"
                                        @if($category->id==Request::input('category_id')) selected @endif >
                                    {{$category->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <hr>
            <form>
                <div class="am-g">
                    <div class="am-u-sm-12">
                        <table class="am-table am-table-bd am-table-striped admin-content-table">
                            <thead>
                            <tr>
                                <th><input type="checkbox" id="checkAll" class="ace"></th>
                                <th>编号</th>
                                <th>缩略图</th>
                                <th>标题</th>
                                <th>所属分类</th>
                                <th>描述信息</th>
                                <th>排序</th>
                                <th>发布日期</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($ads as $ad)
                                <tr data-id="{{$ad->id}}">
                                    <td><input type="checkbox" name="id[]" value="{{$ad->id}}"
                                               class=" checkOne checked_id">
                                    </td>
                                    <td>{{$ad->id}}</td>
                                    <td><img width="40px;" height="40px;" src="{{$ad->image}}"></td>
                                    <td>{{$ad->title}}</td>
                                    <td>{{$ad->category->name or ''}}</td>
                                    <td>{!! $ad->description !!}</td>
                                    <td><input type="text" class="sort_order" value="{{$ad->sort_order}}"
                                               style="width: 70px;"></td>
                                    <td>{{$ad->created_at}}</td>
                                    <td>
                                        <div class="am-btn-toolbar">
                                            <div class="am-btn-group am-btn-group-xs">
                                                <a style="color:#1006F1"
                                                   class="am-btn am-btn-default am-btn-xs am-text-secondary"
                                                   href="{{route('ads.ad.edit',$ad->id)}}"><span
                                                            class="am-icon-pencil-square-o"></span> 编辑
                                                </a>
                                                <a style=" color:#ff0000;" href="{{route('ads.ad.destroy',$ad->id)}}"
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
                            注 : 共 {{$ads->total()}} 条记录
                            <div class="am-fr all">
                                {{ $ads->links() }}
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
    <script src="/js/ads/ad.js"></script>
    <script>
        //切换栏目`
        $("#change_category").change(function () {
            var category_id = $(this).val();
            if (category_id == "-1") {
                location.href = "/admin/ads/ad";
                return false;
            }
            var url = "/admin/ads/ad?category_id=" + category_id;
            location.href = url;
        })
    </script>
@endsection



