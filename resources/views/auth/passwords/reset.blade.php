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
@extends('layouts.app')
@section('content')
    <div class="header">
        <h1>Shop 商城重置密码页面</h1>
        <p>Integrated Development Environment<br/>代码编辑，代码生成，界面设计，调试，编译</p>
    </div>
    <hr/>
    <div class="container">
        <br/>
        <br/>
        <br/>
        <br/>
        <div class="panel-body" style="margin-right: 100px;">
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            <form class="form-horizontal" method="POST" action="{{ route('password.request') }}">
                {{ csrf_field() }}
                <input type="hidden" name="token" value="{{ $token }}">
                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email" class="col-md-4 control-label">邮箱</label>
                    <div class="col-md-6">
                        <div class="am-form-group am-form-icon">
                            <i class="am-icon-envelope"></i>
                            <input id="email" type="email" class="am-form-field" name="email" placeholder="输入你的邮箱号"
                                   value="{{ old('email') }}" required>
                        </div>
                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <br/>
                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <label for="password" class="col-md-4 control-label">密码</label>
                    <div class="col-md-6">
                        <div class="am-form-group am-form-icon">
                            <i class="am-icon-key"></i>
                            <input id="password" type="password" placeholder="请输入您的密码"
                                   class="form-control am-form-group am-form-field"
                                   name="password" required>
                        </div>
                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <br/>
                <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                    <label for="password-confirm" class="col-md-4 control-label ">确认密码</label>
                    <div class="col-md-6 am-form-group am-form-icon">
                        <div class="am-form-group am-form-icon">
                            <i class="am-icon-key"></i>
                            <input id="password-confirm" placeholder="请确认您的密码" type="password"
                                   class="form-control am-form-field"
                                   name="password_confirmation" required>
                        </div>
                        @if ($errors->has('password_confirmation'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password_confirmation') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                        <button type="submit" class="am-btn am-btn-secondary am-round">
                            <span style="color:#2F3133;">修 改</span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
