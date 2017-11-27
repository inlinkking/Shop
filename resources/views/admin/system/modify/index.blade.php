@extends('layouts.admin.application')
@section('content')
    <div class="admin-content">
        <div class="admin-content-body">
            <div class="am-cf am-padding am-padding-bottom-0">
                <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">修改密码</strong> /
                    <small>Modify Brands</small>
                </div>
            </div>
            <hr/>
            <div class="am-g">
                <div class="am-u-sm-12 am-u-md-4 am-u-md-push-8">
                    <img src="/vendor/amazeui/image/20150820180003_ZXmkB.thumb.700_0.png" width="360px;" alt="妹子">
                </div>
                <div class="am-u-sm-12 am-u-md-8 am-u-md-pull-4">
                    @include('layouts.admin._flash')
                    <form class="am-form am-form-horizontal" action="{{route('system.modify.store')}}"
                          method="post">
                        {{csrf_field()}}
                        {{method_field('PUT')}}
                        <div class="am-form-group am-form-warning">
                            <label for="user-name" class="am-u-sm-3 am-form-label">用户名 : </label>
                            <div class="am-u-sm-9 am-form-icon am-form-feedback">
                                <input type="text" name="name" value="{{Auth::user()->name}}"
                                       class="am-form-field am-form-warning"
                                       disabled>
                                <span class="am-icon-user"></span>
                            </div>
                        </div>
                        <div class="am-form-group am-form-success">
                            <label class="am-u-sm-3 am-form-label">邮箱 : </label>
                            <div class="am-u-sm-9 am-form-icon am-form-feedback">
                                <input type="email" name="email">
                                <span class="am-icon-envelope"></span>
                            </div>
                        </div>
                        <div class="am-form-group am-form-success">
                            <label class="am-u-sm-3 am-form-label">手机号码 : </label>
                            <div class="am-u-sm-9 am-form-icon am-form-feedback">
                                <input type="text" name="mobile">
                                <span class="am-icon-phone"></span>
                            </div>
                        </div>
                        <div class="am-form-group am-form-success">
                            <label class="am-u-sm-3 am-form-label">原始密码 : </label>
                            <div class="am-u-sm-9 am-form-icon am-form-feedback">
                                <input type="password" name="change_password">
                                <span class="am-icon-key"></span>
                            </div>
                        </div>
                        <div class="am-form-group am-form-success">
                            <label class="am-u-sm-3 am-form-label">新密码 : </label>
                            <div class="am-u-sm-9 am-form-icon am-form-feedback">
                                <input type="password" name="password">
                                <span class="am-icon-key"></span>
                            </div>
                        </div>
                        <div class="am-form-group am-form-success">
                            <label class="am-u-sm-3 am-form-label">确认密码 : </label>
                            <div class="am-u-sm-9 am-form-icon am-form-feedback">
                                <input type="password" name="password_confirmation">
                                <span class="am-icon-key"></span>
                            </div>
                        </div>
                        <div class="am-form-group">
                            <div class="am-u-sm-9 am-u-sm-push-3">
                                <button type="submit" class="am-btn am-btn-primary">保存修改</button>
                            </div>
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
