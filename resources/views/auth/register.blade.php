<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>my-xieqing</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="format-detection" content="telephone=no">
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp"/>
    <link rel="alternate icon" type="image/png" href="/vendor/amazeui/assets/i/favicon.png">
    <link rel="stylesheet" href="/vendor/amazeui/assets/css/amazeui.min.css"/>
    <style>
        .header {
            text-align: center;
        }

        .header h1 {
            font-size: 200%;
            color: #333;
            margin-top: 30px;
        }

        .header p {
            font-size: 14px;
        }
    </style>
</head>
<body>
@extends('layouts.app')
@section('content')
    <div class="header">
        <h1>Shop 商城账号注册页面</h1>
        <p>Integrated Development Environment<br/>代码编辑，代码生成，界面设计，调试，编译</p>
    </div>
    <hr/>
    <div class="am-g">
        <div class="am-u-lg-6 am-u-md-8 am-u-sm-centered">
            <br/>
            @include('layouts.admin._flash')
            <form method="post" action="{{ route('register') }}" class="am-form">
                {{ csrf_field() }}
                <input type="hidden" name="is_show" value="1">
                <div class="am-form-group am-form-icon">
                    <label>用户名:</label>
                    <input type="hidden" value="1" name="is_show">
                    <i class="am-icon-user"></i>
                    <input type="text" name="name" class="am-form-field"
                           value="{{ old('name') }}" placeholder="用户名" required autofocus>
                </div>
                <br>
                <div class="am-form-group am-form-icon">
                    <label>真实姓名:</label>
                    <i class="am-icon-user"></i>
                    <input type="text" name="real" class="am-form-field" placeholder="请输入您的真实姓名">
                </div>
                <br/>
                <div class="am-form-group am-form-icon">
                    <label>邮箱:</label>
                    <i class="am-icon-envelope"></i>
                    <input type="email" name="email" value="{{ old('email') }}" placeholder="邮箱" class="am-form-field"
                           required autofocus>
                </div>
                <br>
                <div class="am-form-group am-form-icon">
                    <label>手机号码:</label>
                    <i class="am-icon-phone"></i>
                    <input type="text" name="mobile" value="{{ old('mobile') }}" class="am-form-field"
                           placeholder="手机号" required autofocus>
                </div>
                <br>
                <div class="am-form-group am-form-icon">
                    <label>密码:</label>
                    <i class="am-icon-key"></i>
                    <input type="password" name="password" placeholder="密码" class="am-form-field" required>
                </div>
                <br/>
                <div class="am-form-group am-form-icon">
                    <label>确认密码:</label>
                    <i class="am-icon-key"></i>
                    <input type="password" name="password_confirmation" class="am-form-field" placeholder="确认密码"
                           required>
                </div>
                <br/>
                <div class="am-form-group am-form-icon">
                    <input type="checkbox" name="role_id" value="5"> 普通用户
                </div>
                <br/>
                <br/>
                <div class="am-cf">
                    <button type="submit" class="am-btn am-btn-secondary am-round am-fl"><span
                                style="color:#2F3133;">注 册</span></button>
                    <button class="am-btn am-btn-danger am-round am-fr"><a
                                style="text-decoration:none; color:#ffff00;"
                                href="{{ route('login') }}">已有账号 ^_^?</a></button>
                </div>
            </form>
            <hr>
            <p>© 2017 my-xieqing Inc. Licensed under MIT license.</p>
        </div>
    </div>
@endsection
<script src="/vendor/amazeui/assets/js/jquery.min.js"></script>
<script src="/vendor/amazeui/assets/js/amazeui.min.js"></script>
</body>
</html>