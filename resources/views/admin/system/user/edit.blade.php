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
                    <strong class="am-text-primary am-text-lg">编辑用户</strong> /
                    <small>Edit User</small>
                </div>
            </div>
            <hr>
            <div class=" am-margin">
                <div class="am-tab-panel">
                    @include('layouts.admin._flash')
                    <form class="am-form" action="{{route('system.user.update',$user->id)}}" method="post">
                        {{csrf_field()}}
                        {{ method_field('PUT') }}
                        <div class="am-g am-margin-top">
                            <div class="am-u-sm-4 am-u-md-2 am-text-right">
                                用户名
                            </div>
                            <div class="am-u-sm-8 am-u-md-4 am-u-end col-end">
                                <input type="text" name="name" value="{{old('name')?old('name'):$user->name}}"
                                       class="am-input-sm">
                            </div>
                        </div>

                        <div class="am-g am-margin-top">
                            <div class="am-u-sm-4 am-u-md-2 am-text-right">
                                真实姓名
                            </div>
                            <div class="am-u-sm-8 am-u-md-4 am-u-end col-end">
                                <input type="text" name="real" value="{{old('real')?old('real'):$user->real}}"
                                       class="am-input-sm">
                            </div>
                        </div>

                        <div class="am-g am-margin-top">
                            <div class="am-u-sm-4 am-u-md-2 am-text-right">
                                手机号
                            </div>
                            <div class="am-u-sm-8 am-u-md-4 am-u-end col-end">
                                <input type="text" name="mobile" value="{{old('mobile')?old('mobile'):$user->mobile}}"
                                       class="am-input-sm">
                            </div>
                        </div>

                        <div class="am-g am-margin-top">
                            <div class="am-u-sm-4 am-u-md-2 am-text-right">
                                邮箱
                            </div>
                            <div class="am-u-sm-8 am-u-md-4 am-u-end col-end">
                                <input type="email" name="email" value="{{old('email')?old('email'):$user->email}}"
                                       class="am-input-sm">
                            </div>
                        </div>
                        <div class="am-g am-margin-top">
                            <div class="am-u-sm-4 am-u-md-2 am-text-right">
                                原始密码
                            </div>
                            <div class="am-u-sm-8 am-u-md-4  am-u-end col-end">
                                <input type="password" name="old_password" class="am-input-sm">
                            </div>
                        </div>
                        <div class="am-g am-margin-top">
                            <div class="am-u-sm-4 am-u-md-2 am-text-right">
                                新密码
                            </div>
                            <div class="am-u-sm-8 am-u-md-4  am-u-end col-end">
                                <input type="password" name="password" class="am-input-sm">
                            </div>
                        </div>
                        <div class="am-g am-margin-top">
                            <div class="am-u-sm-4 am-u-md-2 am-text-right">
                                确认密码
                            </div>
                            <div class="am-u-sm-8 am-u-md-4  am-u-end col-end">
                                <input type="password" name="password_confirmation" class="am-input-sm">
                            </div>
                        </div>
                        <div class="am-g am-margin-top">
                            <div class="am-u-sm-4 am-u-md-2 am-text-right">
                                选择用户组
                            </div>
                            <div class="am-u-sm-8 am-u-md-4  am-u-end col-end">
                                @foreach($roles as $role)
                                    <label class="am-checkbox-inline">
                                        <input type="checkbox" value="{{$role->id}}" name="role_id[]"
                                               @if($role->id == $user_roles->contains($role->id)) checked @endif>
                                        {{$role->name}}
                                    </label>
                                @endforeach
                            </div>
                        </div>
                        <div class="am-margin" style="margin-left: 220px;">
                            <button type="submit" class="am-btn am-btn-primary am-btn-xs">提交保存</button>
                            <a href="{{route('system.user.index')}}" class="am-btn am-btn-primary am-btn-xs">放弃保存</a>
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

