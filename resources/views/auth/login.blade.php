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

        #word {
            position: relative;
        }

        #capital {
            position: absolute;
            margin-left: 260px;
            margin-top: 154px;
        }
    </style>
</head>
<body>
@extends('layouts.app')
@section('content')
    <div class="header">
        <h1>Shop 商城账号登录页面</h1>
        <p>Integrated Development Environment<br/>代码编辑，代码生成，界面设计，调试，编译</p>
    </div>
    <hr/>
    <div class="am-g">
        <div id="capital" style="color: #ff2222; display:none;">大写锁定已开启</div>
        <div class="am-u-lg-6 am-u-md-8 am-u-sm-centered">
            <br/>
            @include('layouts.admin._flash')
            <form method="post" action="{{ route('login') }}" class="am-form">
                {{ csrf_field() }}
                <label for="name">账号:</label>
                <div class="am-form-group am-form-icon">
                    <i class="am-icon-user"></i>
                    <input type="text" name="name" id="name" value="{{ old('name') }}"
                           class="am-form-field" placeholder="用户名/邮箱/手机号" required autofocus>
                </div>
                <br>
                <label id="word" for="password">密码:</label>
                <div class="am-form-group am-form-icon">
                    <i class="am-icon-key"></i>
                    <input type="password" id="loginPasswd" name="password" class="am-form-field" placeholder="密码"
                           required>
                </div>

                <br>
                <label for="captcha">验证码:</label>
                <div class="am-g">
                    <div class="am-u-md-8 am-u-md-push-4 am-u-lg-reset-order">
                        <input type="text" name="captcha" id="captcha" value="" placeholder="验证码" required>
                    </div>
                    <div class="am-u-md-4 am-u-md-pull-8 am-u-lg-reset-order">
                        <img src="{{captcha_src()}}" style="cursor: pointer"
                             onclick="this.src='{{captcha_src()}}&'+Math.random()">
                    </div>
                </div>
                <br>
                <label style="float: left;">
                    <input value="remember-me" name="remember-me" type="checkbox" {{ old('remember') ? 'checked' : '' }}>
                    记住密码
                </label>
                <div class="am-form-group am-form-icon" style="float: left;margin-left: 30px;">
                    <input type="checkbox" value="1" id="xian"> 显示密码
                </div>
                <br/>
                <br/>
                <div class="am-cf">
                    <button type="submit" class="am-btn am-btn-secondary am-round am-fl">
                        <span style="color:#2F3133;">登 陆</span>
                    </button>
                    <button class="am-btn am-btn-danger am-round am-fr">
                        <a style="text-decoration:none; color:#ffff00;" href="{{ route('register') }}">没有账号 ^_^?</a>
                    </button>
                    <button class="am-btn am-btn-success am-round" style="margin-left: 200px;">
                        <a style="color:#000000; text-decoration:none" href="{{ route('password.request') }}">忘记密码^_^? </a>
                    </button>
                </div>
            </form>
            <hr>
            <p>© 2017 my-xieqing Inc. Licensed under MIT license.</p>
        </div>
    </div>
@endsection
<script src="/vendor/amazeui/assets/js/jquery.min.js"></script>
<script src="/vendor/amazeui/assets/js/amazeui.min.js"></script>
<script>
    $(function () {
        /* 检测输入框的大小写是否开启 */
        window.onload = function () {
            function isIE() {
                if (!!window.ActiveXObject || "ActiveXObject" in window) {
                    return true;
                }
                else {
                    return false;
                }
            }

            (function () {
                var inputPWD = document.getElementById('loginPasswd');
                var capital = false;
                var capitalTip = {
                    elem: document.getElementById('capital'),
                    toggle: function (s) {
                        var sy = this.elem.style;
                        var d = sy.display;
                        if (s) {
                            sy.display = s;
                        }
                        else {
                            sy.display = d == 'none' ? '' : 'none';
                        }
                    }
                }
                var detectCapsLock = function (event) {
                    if (capital) {
                        return
                    }
                    ;
                    var e = event || window.event;
                    var keyCode = e.keyCode || e.which;
                    var isShift = e.shiftKey || (keyCode == 16 ) || false;
                    if (((keyCode >= 65 && keyCode <= 90 ) && !isShift) || ((keyCode >= 97 && keyCode <= 122 ) && isShift)) {
                        capitalTip.toggle('block');
                        capital = true
                    }
                    else {
                        capitalTip.toggle('none');
                    }
                }
                if (!isIE()) {
                    inputPWD.onkeypress = detectCapsLock;
                    inputPWD.onkeyup = function (event) {
                        var e = event || window.event;
                        if (e.keyCode == 20 && capital) {
                            capitalTip.toggle();
                            return false;
                        }
                    }
                }
            })()
        }
        /* 通过多选框 实现密码显示与隐藏设置 */
        function $(id) {
            return document.getElementById(id);
        }

        $('xian').onclick = function () {
            var xuan = $('xian').checked;
            var loginPasswd = $("loginPasswd");
            if (xuan == true) {
                loginPasswd.type = "text";
            } else {
                loginPasswd.type = "password";
            }
        }
    })
</script>
</body>
</html>