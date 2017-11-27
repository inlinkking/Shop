{{--/**--}}
{{--* Created by PhpStorm.--}}
{{--* User: xieqi--}}
{{--* Date: 2017/9/7--}}
{{--* Time: 14:46--}}
{{--*/--}}
@extends('layouts.admin.application')
@section('content')
    <div class="admin-content">
        <div class="admin-content-body">
            <div class="am-cf am-padding am-padding-bottom-0">
                <div class="am-fl am-cf">
                    <strong class="am-text-primary am-text-lg">新增菜单</strong> /
                    <small>Create Permissions</small>
                </div>
            </div>
            <hr>
            <div class=" am-margin">
                <div class="am-tab-panel">
                    @include('layouts.admin._flash')
                    <form class="am-form am-form-inline" action="{{route('system.permission.store')}}" method="post">
                        {{csrf_field()}}
                        <div class="am-g am-margin-top">
                            <div class="am-u-sm-4 am-u-md-2 am-text-right">
                                上级菜单
                            </div>
                            <div class="am-u-sm-8 am-u-md-4 am-u-end col-end">
                                <select name="parent_id">
                                    <option value="0">顶级菜单</option>
                                    @foreach($permissions as $permission)
                                        <option value="{{$permission->id}}">{{$permission->name}}</option>
                                        @foreach($permission->children as $child)
                                            <option value="{{$child->id}}">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                &nbsp;&nbsp;&nbsp;{{$child->name}}</option>
                                            @foreach($child->children as $chi)
                                                <option value="{{$chi->id}}" disabled>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                    &nbsp;&nbsp;&nbsp;{{$chi->name}}</option>
                                            @endforeach
                                        @endforeach
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="am-g am-margin-top">
                            <div class="am-u-sm-4 am-u-md-2 am-text-right">
                                菜单名称
                            </div>
                            <div class="am-u-sm-8 am-u-md-4">
                                <input type="text" name="name" class="am-input-sm">
                            </div>
                            <div class="am-hide-sm-only am-u-md-6">*必填，不可重复</div>
                        </div>

                        <div class="am-g am-margin-top">
                            <div class="am-u-sm-4 am-u-md-2 am-text-right">
                                图标
                            </div>
                            <div class="am-form-group am-form-icon" style="width: 380px;margin-left: 15px;">
                                <i class=""></i>
                                <input type="text" oninput="myFunction()" id="icon" name="icon" class="am-form-field">
                            </div>
                        </div>
                        <div class="am-g am-margin-top">
                            <div class="am-u-sm-4 am-u-md-2 am-text-right">
                                排序
                            </div>
                            <div class="am-u-sm-8 am-u-md-4">
                                <input type="text" name="sort_order" class="am-input-sm">
                            </div>
                            <div class="am-hide-sm-only am-u-md-6">必须为整数</div>
                        </div>
                        <div class="am-g am-margin-top">
                            <div class="am-u-sm-4 am-u-md-2 am-text-right">
                                权限名称
                            </div>
                            <div class="am-u-sm-8 am-u-md-4  am-u-end col-end">
                                <textarea rows="5" name="label" class="am-input-sm"></textarea>
                            </div>
                        </div>

                        <div class="am-margin" style="margin-left: 220px;">
                            <button type="submit" class="am-btn am-btn-primary am-btn-xs">提交保存</button>
                            <a href="{{route('system.permission.index')}}"
                               class="am-btn am-btn-primary am-btn-xs">放弃保存</a>
                        </div>
                    </form>
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
    <script>
        function myFunction() {
            var a = $('#icon').val()
            $('#icon').prev('i').attr('class', a);
        }
    </script>
@endsection
