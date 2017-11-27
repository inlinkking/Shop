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
                    <strong class="am-text-primary am-text-lg">新增分类</strong> /
                    <small>Create Ad_category</small>
                </div>
            </div>
            <hr>
            <div class=" am-margin">
                <div class="am-tab-panel">
                    @include('layouts.admin._flash')
                    <form class="am-form" action="{{route('ads.ad_category.update',$ad_category->id)}}" method="post">
                        {{csrf_field()}}
                        {{ method_field('PUT') }}
                        <div class="am-g am-margin-top">
                            <div class="am-u-sm-4 am-u-md-2 am-text-right">
                                分类名称
                            </div>
                            <div class="am-u-sm-8 am-u-md-4">
                                <input type="text" name="name" value="{{$ad_category->name}}" class="am-input-sm">
                            </div>
                            <div class="am-hide-sm-only am-u-md-6"></div>
                        </div>
                        <div class="am-g am-margin-top">
                            <div class="am-u-sm-4 am-u-md-2 am-text-right">
                                缩略图
                            </div>
                            <div class="am-u-sm-8 am-u-md-8 am-u-end col-end">
                                <div class="am-form-group am-form-file new_thumb">
                                    <button type="button" class="am-btn am-btn-success asd am-btn-sm">
                                        <i class="am-icon-cloud-upload" id="loading"></i> 上传图片
                                    </button>
                                    <input type="file" id="image_upload">
                                    <input type="hidden" name="image" value="{{$ad_category->image}}">
                                </div>
                                <hr data-am-widget="divider" style="" class="am-divider am-divider-dashed"/>
                                <div>
                                    <img src="{{$ad_category->image}}" id="img_show" style="max-height: 222px;">
                                </div>
                            </div>
                        </div>
                        <div class="am-g am-margin-top">
                            <div class="am-u-sm-4 am-u-md-2 am-text-right">
                                排序
                            </div>
                            <div class="am-u-sm-8 am-u-md-4">
                                <input type="text" value="{{$ad_category->sort_order}}" name="sort_order"
                                       class="am-input-sm">
                            </div>
                            <div class="am-hide-sm-only am-u-md-6">必须为整数</div>
                        </div>
                        <div class="am-g am-margin-top">
                            <div class="am-u-sm-4 am-u-md-2 am-text-right">
                                内容描述
                            </div>
                            <div role="tabpanel" style="margin:0 205px 0 0;" class="am-u-sm-8" id="profile">
                                <script id="container" name="description"
                                        type="text/plain">{!! $ad_category->description !!}</script>
                            </div>
                        </div>
                        <div class="am-margin" style="margin-left: 220px;">
                            <button type="submit" class="am-btn am-btn-primary am-btn-xs">提交保存</button>
                            <a href="{{route('ads.ad_category.index')}}"
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
    <script type="text/javascript" src="/vendor/ueditor/ueditor.config.js"></script>
    <!-- 编辑器源码文件 -->
    <script type="text/javascript" src="/vendor/ueditor/ueditor.all.js"></script>
    <script>
        $(function () {
            var ue = UE.getEditor('container', {
                autoHeighht: true
            });
        });
    </script>
@endsection