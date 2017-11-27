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
                    <strong class="am-text-primary am-text-lg">编辑菜单</strong> /
                    <small>Edit Permissions</small>
                </div>
            </div>
            <hr>
            <div class=" am-margin">
                <div class="am-tab-panel">
                    @include('layouts.admin._flash')
                    <form class="am-form am-form-inline" action="{{route('system.permission.update',$permission->id)}}"
                          method="post">
                        {{csrf_field()}}
                        {{method_field('PUT')}}
                        <div class="am-g am-margin-top">
                            <div class="am-u-sm-4 am-u-md-2 am-text-right">
                                上级菜单
                            </div>
                            <div class="am-u-sm-8 am-u-md-4 am-u-end col-end">
                                <select name="parent_id">
                                    <option value="0" @if($permission->parent_id==0) selected @endif>顶级菜单</option>
                                    @foreach($permissions as $permiss)
                                        <option value="{{$permiss->id}}"
                                                @if($permiss->id==$permission->parent_id) selected @endif
                                        >{{$permiss->name}}</option>
                                        @foreach($permiss->children as $child)
                                            <option value="{{$child->id}}"
                                                    @if($child->id == $permission->parent_id) selected @endif>
                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                &nbsp;&nbsp;&nbsp;{{$child->name}}</option>
                                            @foreach($child->children as $chi)
                                                <option value="{{$chi->id}}">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
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
                                <input type="text" name="name" value="{{$permission->name}}" class="am-input-sm">
                            </div>
                            <div class="am-hide-sm-only am-u-md-6"></div>
                        </div>

                        <div class="am-g am-margin-top">
                            <div class="am-u-sm-4 am-u-md-2 am-text-right">
                                图标
                            </div>
                            <div class="am-form-group am-form-icon" style="width: 380px;margin-left: 15px;">
                                <i class="{{$permission->icon}}"></i>
                                <input type="text" oninput="myFunction()" id="icon" value="{{$permission->icon}}"
                                       name="icon" class="am-form-field">
                            </div>
                        </div>
                        <div class="am-g am-margin-top">
                            <div class="am-u-sm-4 am-u-md-2 am-text-right">
                                排序
                            </div>
                            <div class="am-u-sm-8 am-u-md-4">
                                <input type="text" value="{{$permission->sort_order}}" name="sort_order"
                                       class="am-input-sm">
                            </div>
                            <div class="am-hide-sm-only am-u-md-6">必须为整数</div>
                        </div>
                        <div class="am-g am-margin-top">
                            <div class="am-u-sm-4 am-u-md-2 am-text-right">
                                权限名称
                            </div>
                            <div class="am-u-sm-8 am-u-md-4  am-u-end col-end">
                                <textarea rows="5" name="label" class="am-input-sm">{{$permission->label}}</textarea>
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
