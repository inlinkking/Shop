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
                    <strong class="am-text-primary am-text-lg">新增品牌分类</strong> /
                    <small>Create Brand Category</small>
                </div>
            </div>
            <hr>
            <div class=" am-margin">
                <div class="am-tab-panel">
                    @include('layouts.admin._flash')
                    <form class="am-form" action="{{route('shop.category.store')}}" method="post">
                        {{csrf_field()}}
                        <div class="am-g am-margin-top">
                            <div class="am-u-sm-4 am-u-md-2 am-text-right">
                                上级分类
                            </div>
                            <div class="am-u-sm-8 am-u-md-4 am-u-end col-end">
                                <select name="parent_id"
                                        data-am-selected="{btnWidth: '100%',  btnStyle: 'secondary', btnSize: 'sm',  searchBox: 1}">
                                    <option value="0">顶级分类</option>
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="am-g am-margin-top">
                            <div class="am-u-sm-4 am-u-md-2 am-text-right">
                                品牌名称
                            </div>
                            <div class="am-u-sm-8 am-u-md-4">
                                <input type="text" name="name" class="am-input-sm">
                            </div>
                            <div class="am-hide-sm-only am-u-md-6">*必填，不可重复</div>
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
                                    <input type="hidden" name="image">
                                </div>
                                <hr data-am-widget="divider" style="" class="am-divider am-divider-dashed"/>
                                <div>
                                    <img src="" id="img_show" style="max-height: 222px;">
                                </div>
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
                                是否在导航栏显示
                            </div>
                            <div class="am-u-sm-8 am-u-md-4 am-u-end col-end">
                                <label class="am-radio-inline">
                                    <input type="radio" value="1" name="is_show" checked> 是
                                </label>
                                <label class="am-radio-inline">
                                    <input type="radio" name="is_show" value="0"> 否
                                </label>
                            </div>
                        </div>
                        <div class="am-margin" style="margin-left: 220px;">
                            <button type="submit" class="am-btn am-btn-primary am-btn-xs">提交保存</button>
                            <a href="{{route('shop.category.index')}}" class="am-btn am-btn-primary am-btn-xs">放弃保存</a>
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

