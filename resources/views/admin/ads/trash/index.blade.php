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
                <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">回收站</strong> /
                    <small>Trash Brands</small>
                </div>
            </div>
            @include('layouts.admin._flash')
            <div class="am-g">
                <div class="am-u-sm-12 am-u-md-6">
                    <div class="am-btn-toolbar">
                        <div class="am-btn-group am-btn-group-xs">
                            <a href="javascript:void(0);" id="del_all" style="color:#1a18ff;"
                               class="am-btn am-btn-default"><span
                                        class="am-icon-reply"></span> 还 原
                            </a>
                            <a href="javascript:void(0);" style=" color:#ff0000;" id="delete_all"
                               class="am-btn am-btn-default"><span
                                        class="am-icon-trash-o"></span> 删 除
                            </a>
                        </div>
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
                                <th>ID</th>
                                <th>缩略图</th>
                                <th>标题</th>
                                <th>所属分类</th>
                                <th>发布日期/删除日期</th>
                                <th class="table-set">操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($trashs as $trash)
                                <tr data-id="{{$trash->id}}">
                                    <td><input type="checkbox" name="id[]" value="{{$trash->id}}"
                                               class="ace checkOne checked_id">
                                    </td>
                                    <td>{{$trash->id}}</td>
                                    <td><img width="40px;" height="40px;" src="{{$trash->image}}"></td>
                                    <td>{{$trash->title}}</td>
                                    <td>{{$trash->category['name']}}</td>
                                    <td>{{$trash->created_at}} / {{$trash->deleted_at}}</td>
                                    <td>
                                        <div class="am-btn-toolbar">
                                            <div class="am-btn-group am-btn-group-xs">
                                                <a style="   color:#1a18ff;"
                                                   href="javascript:void(0);" id="del_hui"
                                                   class="am-btn am-btn-default am-btn-xs am-text-danger am-hide-sm-only">
                                                    <span class="am-icon-reply"></span> 还原
                                                </a>
                                                <a style=" color:#ff0000;" href="javascript:void(0);" id="delete_dan"
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
                            注 : 共 {{$trashs->total()}} 条记录
                            <div class="am-fr all">
                                {{ $trashs->links() }}
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
    <script src="/js/ads/trash.js"></script>
@endsection