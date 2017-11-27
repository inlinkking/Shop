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
                    <strong class="am-text-primary am-text-lg">编辑快递方式</strong> /
                    <small>Edit Express</small>
                </div>
            </div>
            <hr>
            <div class=" am-margin">
                <div class="am-tab-panel">
                    @include('layouts.admin._flash')
                    <form class="am-form" action="{{route('shop.express.update',$express->id)}}" method="post">
                        {{csrf_field()}}
                        {{ method_field('PUT') }}
                        <div class="am-g am-margin-top">
                            <div class="am-u-sm-4 am-u-md-2 am-text-right">
                                快递名称
                            </div>
                            <div class="am-u-sm-8 am-u-md-4">
                                <input type="text" name="name" value="{{$express->name}}" class="am-input-sm">
                            </div>
                            <div class="am-hide-sm-only am-u-md-6"></div>
                        </div>

                        <div class="am-g am-margin-top">
                            <div class="am-u-sm-4 am-u-md-2 am-text-right">
                                快递公司代码
                            </div>
                            <div class="am-u-sm-8 am-u-md-4 am-u-end col-end">
                                <input type="text" name="code" value="{{$express->code}}" class="am-input-sm">
                            </div>
                            <div class="am-hide-sm-only am-u-md-6">*必填，不可重复
                                <a href="http://www.kuaidi100.com/download/api_kuaidi100_com(20140729).doc">查看代码</a>
                            </div>

                        </div>

                        <div class="am-g am-margin-top">
                            <div class="am-u-sm-4 am-u-md-2 am-text-right">
                                网址
                            </div>
                            <div class="am-u-sm-8 am-u-md-4 am-u-end col-end">
                                <input type="text" name="url" value="{{$express->url}}" class="am-input-sm">
                            </div>
                        </div>

                        <div class="am-g am-margin-top">
                            <div class="am-u-sm-4 am-u-md-2 am-text-right">
                                运费
                            </div>
                            <div class="am-u-sm-8 am-u-md-4 am-u-end col-end">
                                <input type="text" name="shipping_money" value="{{$express->shipping_money}}"
                                       class="am-input-sm">
                            </div>
                        </div>

                        <div class="am-g am-margin-top">
                            <div class="am-u-sm-4 am-u-md-2 am-text-right">
                                满额包邮
                            </div>
                            <div class="am-u-sm-8 am-u-md-4 am-u-end col-end">
                                <input type="text" name="shipping_free" value="{{$express->shipping_free}}"
                                       class="am-input-sm">
                            </div>
                        </div>

                        <div class="am-g am-margin-top">
                            <div class="am-u-sm-4 am-u-md-2 am-text-right">
                                配送方式描述
                            </div>
                            <div class="am-u-sm-8 am-u-md-4 am-u-end col-end">
                                <textarea name="description" rows="5"
                                          class="am-input-sm">{{$express->description}}</textarea>
                            </div>
                        </div>

                        <div class="am-g am-margin-top">
                            <div class="am-u-sm-4 am-u-md-2 am-text-right">
                                是否可用
                            </div>
                            <div class="am-u-sm-8 am-u-md-4 am-u-end col-end">
                                <label class="am-radio-inline">
                                    <input type="radio" value="1" name="is_enable"
                                           @if($express->is_enable==1) checked @endif> 是
                                </label>
                                <label class="am-radio-inline">
                                    <input type="radio" name="is_enable" value="0"
                                           @if($express->is_enable==0) checked @endif> 否
                                </label>
                            </div>
                        </div>

                        <div class="am-g am-margin-top">
                            <div class="am-u-sm-4 am-u-md-2 am-text-right">
                                排序
                            </div>
                            <div class="am-u-sm-8 am-u-md-4 am-u-end col-end">
                                <input type="text" name="sort_order" value="{{$express->sort_order}}"
                                       class="am-input-sm">
                            </div>
                        </div>

                        <div class="am-margin" style="margin-left: 220px;">
                            <button type="submit" class="am-btn am-btn-primary am-btn-xs">提交保存</button>
                            <a href="{{route('shop.express.index')}}" class="am-btn am-btn-primary am-btn-xs">放弃保存</a>
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
