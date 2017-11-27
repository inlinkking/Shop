@extends('layouts.admin.application')
@section('content')
    <!-- content start -->
    <div class="admin-content">
        <div class="admin-content-body">
            <div class="am-cf am-padding am-padding-bottom-0">
                <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">系统设置</strong> /
                    <small>Config Brands</small>
                </div>
            </div>
            <hr/>
            <div class="am-g">
                <div class="am-u-sm-12 am-u-md-4 am-u-md-push-8">
                    <img src="/vendor/amazeui/image/20150815232316_nEvme.png" width="360px;" alt="妹子">
                </div>
                <div class="am-u-sm-12 am-u-md-8 am-u-md-pull-4">
                    @include('layouts.admin._flash')
                    <form class="am-form am-form-horizontal" action="{{route('system.config.store')}}"
                          method="post">
                        {{csrf_field()}}
                        {{method_field('PUT')}}
                        <div class="am-form-group">
                            <label class="am-u-sm-3 am-form-label">网站名称 <span
                                        class="am-badge am-badge-success am-round">title</span></label>
                            <div class="am-u-sm-9">
                                <textarea name="name" rows="3"
                                >@if($config->name == '')暂无@endif{{$config->name}}</textarea>
                            </div>
                        </div>

                        <div class="am-form-group">
                            <label for="user-email" class="am-u-sm-3 am-form-label">关键词 <span
                                        class="am-badge am-badge-warning am-round">keyword</span></label>
                            <div class="am-u-sm-9">
                                <textarea name="word" rows="4"
                                >@if($config->word == '')暂无@endif{{$config->word}}</textarea>
                            </div>
                        </div>

                        <div class="am-form-group">
                            <label for="user-phone" class="am-u-sm-3 am-form-label">描述信息 <span
                                        class="am-badge am-badge-primary am-round">description</span></label>
                            <div class="am-u-sm-9">
                                <textarea name="riptive" rows="5"
                                >@if($config->riptive == '')暂无@endif{{$config->riptive}}</textarea>
                            </div>
                        </div>

                        <div class="am-g am-margin-top">
                            <label for="user-phone" class="am-u-sm-3 am-form-label">网站图标 <span
                                        class="am-badge am-badge-secondary am-round">shortcut icon</span></label>
                            <div class="am-u-sm-8 am-u-md-8 am-u-end col-end">
                                <div class="am-form-group am-form-file new_thumb">
                                    <button type="button" class="am-btn am-btn-success asd am-btn-sm">
                                        <i class="am-icon-cloud-upload" id="loading"></i> 选择要上传的图标
                                    </button>
                                    <input type="file" id="image_upload">
                                    <input type="hidden" value="{{$config->image}}" name="image">
                                </div>
                                <hr data-am-widget="divider" style="" class="am-divider am-divider-dashed"/>
                                <div>
                                    <img src="{{$config->image}}" id="img_show" style="max-height: 70px;">
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="am-form-group">
                            <label for="user-phone" class="am-u-sm-3 am-form-label">ICP备案号</label>
                            <div class="am-u-sm-9">
                                <input type="text" name="record"
                                       value="@if($config->record == '')暂无@endif{{$config->record}}"
                                       class="am-input-sm">
                            </div>
                        </div>

                        <div class="am-form-group">
                            <label for="user-phone" class="am-u-sm-3 am-form-label">版权信息</label>
                            <div class="am-u-sm-9">
                                <input type="text" name="info"
                                       value="@if($config->info == '')暂无@endif{{$config->info}}" class="am-input-sm">
                            </div>
                        </div>

                        <div class="am-form-group">
                            <label for="user-phone" class="am-u-sm-3 am-form-label">管理员信息</label>
                            <div class="am-u-sm-9">
                                <input type="text" name="admin"
                                       value="@if($config->admin == '')暂无@endif{{$config->admin}}" class="am-input-sm">
                            </div>
                        </div>

                        <div class="am-form-group">
                            <label for="user-phone" class="am-u-sm-3 am-form-label">公司名</label>
                            <div class="am-u-sm-9">
                                <input type="text" name="company"
                                       value="@if($config->company == '')暂无@endif{{$config->company}}"
                                       class="am-input-sm">
                            </div>
                        </div>

                        <div class="am-form-group">
                            <label for="user-QQ" class="am-u-sm-3 am-form-label">QQ</label>
                            <div class="am-u-sm-9">
                                <input type="text" name="qq" value="@if($config->qq == '')暂无@endif{{$config->qq}}"
                                       class="am-input-sm">
                            </div>
                        </div>

                        <div class="am-form-group">
                            <label for="user-phone" class="am-u-sm-3 am-form-label">电子邮箱</label>
                            <div class="am-u-sm-9">
                                <input type="text" name="box"
                                       value="@if($config->box == '')暂无@endif{{$config->box}}" class="am-input-sm">
                            </div>
                        </div>

                        <div class="am-form-group">
                            <label for="user-phone" class="am-u-sm-3 am-form-label">手机</label>
                            <div class="am-u-sm-9">
                                <input type="text" name="phone"
                                       value="@if($config->phone == '')暂无@endif{{$config->phone}}" class="am-input-sm">
                            </div>
                        </div>

                        <div class="am-form-group">
                            <label for="user-phone" class="am-u-sm-3 am-form-label">固定电话</label>
                            <div class="am-u-sm-9">
                                <input type="text" name="fixed"
                                       value="@if($config->fixed == '')暂无@endif{{$config->fixed}}" class="am-input-sm">
                            </div>
                        </div>

                        <div class="am-form-group">
                            <label for="user-phone" class="am-u-sm-3 am-form-label">传真</label>
                            <div class="am-u-sm-9">
                                <input type="text" name="fax" value="@if($config->fax == '')暂无@endif{{$config->fax}}"
                                       class="am-input-sm">
                            </div>
                        </div>

                        <div class="am-form-group">
                            <div class="am-u-sm-9 am-u-sm-push-3">
                                <button type="submit" class="am-btn am-btn-primary">保存修改</button>
                                <a href="/admin" class="am-btn am-btn-primary">放弃保存</a>
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
