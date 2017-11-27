@extends('layouts.admin.application')
@section('css')
    <link rel="stylesheet" href="/vendor/markdown/css/editormd.min.css"/>
    <link rel="stylesheet" href="/vendor/webupload/dist/webuploader.css"/>
    <link rel="stylesheet" type="text/css" href="/vendor/webupload/style.css"/>
    <style>
        .am-gallery-imgbordered.xGallery .am-gallery-item img {
            height: 160px;
        }

        .am-gallery-item {
            position: relative;
        }

        .file-panel {
            position: absolute;
            height: 30px;
            display: none;
            filter: progid:DXImageTransform.Microsoft.gradient(GradientType=0,
            startColorstr='#80000000', endColorstr='#80000000') \0;
            background: rgba(0, 0, 0, 0.5);
            width: 100%;
            top: 0;
            left: 0;
            overflow: hidden;
            z-index: 300;
        }

        .file-panel span.cancel {
            background-position: -48px -24px;
        }

        .file-panel span {
            width: 24px;
            height: 24px;
            display: inline;
            float: right;
            text-indent: -9999px;
            overflow: hidden;
            background: url(/vendor/webupload/icons.png) no-repeat;
            margin: 5px 1px 1px;
            cursor: pointer;
        }
    </style>
@endsection
@section('content')
    <div class="admin-content">
        <div class="am-cf am-padding am-padding-bottom-0">
            <div class="am-fl am-cf">
                <strong class="am-text-primary am-text-lg">编辑商品</strong> /
                <small>Edit Product</small>
            </div>
        </div>
        <hr>
        @include('layouts.admin._flash')
        <div class="am-u-sm-12 am-u-md-12">
            <form class="am-form" action="{{route('shop.product.update',$product->id)}}" method="post">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                <div class="am-tabs am-margin" data-am-tabs>
                    <ul class="am-tabs-nav am-nav am-nav-tabs">
                        <li class="am-active"><a href="#tab1">通用信息</a></li>
                        <li><a href="#tab2">商品介绍</a></li>
                        <li><a href="#tab3">商品相册</a></li>
                    </ul>

                    <div class="am-tabs-bd">
                        <div class="am-tab-panel am-fade am-active am-in" id="tab1">
                            <div class="am-g am-margin-top">
                                <div class="am-u-sm-4 am-u-md-2 am-text-right">
                                    所属栏目
                                </div>
                                <div class="am-u-sm-8 am-u-md-4 am-u-end col-end">
                                    <select multiple
                                            data-am-selected="{btnWidth: '100%',  btnStyle: 'secondary'
                                        , btnSize: 'sm',maxHeight:300,searchBox: 1}" name="category_id[]">
                                        @foreach($categories as $category)
                                            <optgroup label="{{$category->name}}">
                                                @foreach($category->children as $child)
                                                    <option value="{{$child->id}}" @if($p_category->
                                                        contains($child->id)) selected @endif>{{$child->name}}</option>
                                                @endforeach
                                            </optgroup>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="am-g am-margin-top">
                                <div class="am-u-sm-4 am-u-md-2 am-text-right">
                                    商品名称
                                </div>
                                <div class="am-u-sm-8 am-u-md-4">
                                    <input type="text" class="am-input-sm" value="{{$product->name}}" name="name">
                                </div>
                                <div class="am-hide-sm-only am-u-md-6"></div>
                            </div>
                            <div class="am-g am-margin-top">
                                <div class="am-u-sm-4 am-u-md-2 am-text-right">
                                    单价
                                </div>
                                <div class="am-u-sm-8 am-u-md-4 am-u-end col-end">
                                    <input type="text" class="am-input-sm" name="price" value="{{$product->price}}">
                                </div>
                            </div>
                            <div class="am-g am-margin-top">
                                <div class="am-u-sm-4 am-u-md-2 am-text-right">
                                    商品品牌
                                </div>
                                <div class="am-u-sm-8 am-u-md-4 am-u-end col-end">
                                    <select data-am-selected="{btnWidth: '100%',  btnStyle: 'secondary',
                                     btnSize: 'sm', maxHeight: 150, searchBox: 1}"
                                            name="brand_id" style="display: none;">
                                        <option value="0">请选择</option>
                                        @foreach($brands as $brand)
                                            <option value="{{$brand->id}}" @if($brand->id == $product->
                                                brand_id) selected @endif>{{$brand->name}}</option>
                                        @endforeach
                                    </select>

                                </div>
                            </div>
                            <div class="am-g am-margin-top">
                                <div class="am-u-sm-4 am-u-md-2 am-text-right">
                                    库存
                                </div>
                                <div class="am-u-sm-8 am-u-md-4 am-u-end col-end">
                                    <input type="text" class="am-input-sm" name="stock" value="{{$product->stock}}">
                                </div>
                            </div>
                            <div class="am-g am-margin-top">
                                <div class="am-u-sm-4 am-u-md-2 am-text-right">
                                    描述
                                </div>
                                <div class="am-u-sm-8 am-u-md-4 am-u-end col-end">
                                    <textarea name="description" rows="5">{{$product->description}}</textarea>
                                </div>
                            </div>
                            <div class="am-g am-margin-top">
                                <div class="am-u-sm-4 am-u-md-2 am-text-right">
                                    上架
                                </div>
                                <div class="am-u-sm-8 am-u-md-4 am-u-end col-end">
                                    <label class="am-radio-inline">
                                        <input type="radio" value="1" name="is_shelves"
                                               @if($product->is_shelves == 1) checked @endif> 是
                                    </label>
                                    <label class="am-radio-inline">
                                        <input type="radio" value="0" name="is_shelves"
                                               @if($product->is_shelves == 0) checked @endif> 否
                                    </label>
                                </div>
                            </div>
                            <div class="am-g am-margin-top">
                                <div class="am-u-sm-4 am-u-md-2 am-text-right">
                                    加入推荐
                                </div>
                                <div class="am-u-sm-8 am-u-md-4 am-u-end col-end">
                                    <input type="hidden" name="is_top" value="0">
                                    <input type="hidden" name="is_recommend" value="0">
                                    <input type="hidden" name="is_selling" value="0">
                                    <input type="hidden" name="is_new" value="0">

                                    <div class="am-btn-group" data-am-button="">
                                        <label class="am-btn am-btn-default am-btn-xs am-round @if($product->
                                            is_top) am-active @endif">
                                            <input type="checkbox" name="is_top" value="1"
                                                   @if($product->is_top) checked @endif> 置顶
                                        </label>
                                        <label class="am-btn am-btn-default am-btn-xs am-round @if($product->
                                            is_recommend) am-active @endif">
                                            <input type="checkbox" name="is_recommend" value="1"
                                                   @if($product->is_recommend) checked @endif> 推荐
                                        </label>
                                        <label class="am-btn am-btn-default am-btn-xs am-round @if($product->
                                            is_selling) am-active @endif">
                                            <input type="checkbox" name="is_selling" value="1"
                                                   @if($product->is_selling) checked @endif> 热销
                                        </label>
                                        <label class="am-btn am-btn-default am-btn-xs am-round @if($product->
                                            is_new) am-active @endif">
                                            <input type="checkbox" name="is_new" value="1"
                                                   @if($product->is_new) checked @endif> 新品
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="am-g am-margin-top">
                                <div class="am-u-sm-4 am-u-md-2 am-text-right">
                                    缩略图
                                </div>

                                <div class="am-u-sm-8 am-u-md-8 am-u-end col-end">
                                    <div class="am-form-group am-form-file new_thumb">
                                        <button type="button" class="am-btn am-btn-success am-btn-sm">
                                            <i class="am-icon-cloud-upload" id="loading"></i> 上传新的缩略图
                                        </button>
                                        <input type="file" id="image_upload">
                                        <input type="hidden" value="{{$product->image}}" name="image" id="image">
                                    </div>

                                    <hr data-am-widget="divider" style="" class="am-divider am-divider-dashed"/>

                                    <div>
                                        <img src="{{$product->image}}" id="img_show" style="max-height: 200px;">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="am-tab-panel am-fade" id="tab2">
                            <div class="am-g am-margin-top-sm">
                                <div class="am-u-sm-12 am-u-md-12">
                                    <div id="markdown">
                                            <textarea rows="10" name="content"
                                                      style="display:none;">{!! $product->content !!}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="am-tab-panel am-fade" id="tab3">
                            <ul data-am-widget="gallery"
                                class="am-gallery am-avg-sm-2 am-avg-md-4 am-avg-lg-6 am-gallery-imgbordered xGallery"
                                data-am-gallery="{ pureview: true }">

                                @foreach($product->product_galleries as $gallery)
                                    <li>
                                        <div class="am-gallery-item">
                                            <a href="{{$gallery->img}}" class="">
                                                <img src="{{$gallery->img}}"/>
                                            </a>
                                            <div class="file-panel" style="display:none;">
                                                <span class="cancel" data-id="{{$gallery->id}}">删除</span>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>


                            <div id="uploader">
                                <div class="queueList">
                                    <div id="dndArea" class="placeholder">
                                        <div id="filePicker"></div>
                                        <p>或将照片拖到这里，单次最多可选300张</p>
                                    </div>
                                </div>
                                <div class="statusBar" style="display:none;">
                                    <div class="progress">
                                        <span class="text">0%</span>
                                        <span class="percentage"></span>
                                    </div>
                                    <div class="info"></div>
                                    <div class="btns">
                                        <div id="filePicker2"></div>
                                        <div class="uploadBtn">开始上传</div>
                                    </div>
                                </div>

                                <div id="imgs"></div>
                            </div>
                        </div>
                    </div>
                    <div class="am-margin">
                        <button type="submit" class="am-btn am-btn-primary am-btn-xs">提交保存</button>
                        <a href="{{route('shop.product.index')}}" class="am-btn am-btn-primary am-btn-xs">放弃保存</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <footer class="admin-content-footer">
        <hr>
        <p class="am-padding-left">© 2017 my-xieqing Inc. Licensed under MIT license.</p>
    </footer>
@endsection
@section('js')
    <script src="/js/upload.js"></script>
    <script src="/vendor/markdown/editormd.min.js"></script>
    <script src="/js/editormd_config.js"></script>
    <script type="text/javascript" src="/vendor/webupload/dist/webuploader.js"></script>
    <script type="text/javascript" src="/vendor/webupload/upload.js"></script>
    <script src="/js/shop/product.js"></script>
    <script>
        $('.am-gallery-item').hover(function () {
            $(this).children('.file-panel').fadeIn(300);
        }, function () {
            $(this).children('.file-panel').fadeOut(300);
        });
        $(".cancel").click(function () {
            if (confirm('确定删除图片')) {
                var _this = $(this);
                var id = $(this).attr('data-id');
                $.ajax({
                    type: 'DELETE',
                    url: '/admin/shop/product/destroy_gallery',
                    data: {id: id},
                    success: function (data) {
                        if (data.status == 0) {
                            alert(data.msg);
                            return false;
                        }
                        _this.parents("li").remove();
                    }
                })
            }
        });
    </script>
@endsection