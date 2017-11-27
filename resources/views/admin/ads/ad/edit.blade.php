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
                    <strong class="am-text-primary am-text-lg">编辑广告</strong> /
                    <small>Edit Ad</small>
                </div>
            </div>
            <hr>
            <div class=" am-margin">
                <div class="am-tab-panel">
                    @include('layouts.admin._flash')
                    <form class="am-form" action="{{route('ads.ad.update',$ad->id)}}" method="post">
                        {{csrf_field()}}
                        {{ method_field('PUT') }}
                        <div class="am-g am-margin-top">
                            <div class="am-u-sm-4 am-u-md-2 am-text-right">
                                所属分类
                            </div>
                            <div class="am-u-sm-8 am-u-md-4 am-u-end col-end">
                                <select data-am-selected="{btnWidth: '100%',  btnStyle: 'secondary',
                                btnSize: 'sm', maxHeight: 360, searchBox: 1}"
                                        name="category_id">
                                    <option value="-1">请选择</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                                @if($category->id==$ad->category_id) selected @endif>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="am-g am-margin-top">
                            <div class="am-u-sm-4 am-u-md-2 am-text-right">
                                广告标题
                            </div>
                            <div class="am-u-sm-8 am-u-md-4">
                                <input type="text" value="{{$ad->title}}" name="title" class="am-input-sm">
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
                                    <input type="hidden" value="{{$ad->image}}" name="image">
                                </div>
                                <hr data-am-widget="divider" style="" class="am-divider am-divider-dashed"/>
                                <div>
                                    <img src="{{$ad->image}}" id="img_show" style="max-height: 222px;">
                                </div>
                            </div>
                        </div>

                        <div class="am-g am-margin-top">
                            <div class="am-u-sm-4 am-u-md-2 am-text-right">
                                广告地址
                            </div>
                            <div class="am-u-sm-8 am-u-md-4 am-u-end col-end">
                                <input type="text" name="url" value="{{$ad->url}}" class="am-input-sm">
                            </div>
                        </div>

                        <div class="am-g am-margin-top">
                            <div class="am-u-sm-4 am-u-md-2 am-text-right">
                                排序
                            </div>
                            <div class="am-u-sm-8 am-u-md-4">
                                <input type="text" value="{{$ad->sort_order}}" name="sort_order" class="am-input-sm">
                            </div>
                            <div class="am-hide-sm-only am-u-md-6">必须为整数</div>
                        </div>
                        <div class="am-g am-margin-top">
                            <div class="am-u-sm-4 am-u-md-2 am-text-right">
                                内容描述
                            </div>
                            <div role="tabpanel" style="margin:0 205px 0 0;" class="am-u-sm-8" id="profile">
                                <script id="container" name="description"
                                        type="text/plain">{!! $ad->description !!}</script>
                            </div>
                        </div>
                        <div class="am-margin" style="margin-left: 220px;">
                            <button type="submit" class="am-btn am-btn-primary am-btn-xs">提交保存</button>
                            <a href="{{route('ads.ad.index')}}"
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
