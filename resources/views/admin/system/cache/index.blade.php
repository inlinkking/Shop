@extends('layouts.admin.application')
@section('content')
    <!-- content start -->
    <div class="admin-content">
        <div class="admin-content-body">
            <div class="am-cf am-padding">
                <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">清除缓存</strong> /
                    <small>Cache Brands</small>
                </div>
            </div>
            <hr/>
            <div class="am-g">
                <div class="am-u-sm-12 am-u-md-4 am-u-md-push-8">
                    <img src="/vendor/amazeui/image/20150815232316_nEvme.png" width="360px;" alt="妹子">
                </div>
                <div class="am-u-sm-12 am-u-md-8 am-u-md-pull-4">
                    @include('layouts.admin._flash')
                    <div class="am-print-hide">
                        <a href="{{route('system.cache.store')}}" data-method="delete"
                           data-token="{{csrf_token()}}"
                           data-confirm="确认清除吗?" class="am-btn am-btn-warning am-btn-block"><i
                                    class="am-icon-refresh am-icon-spin"></i> 清除缓存
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <footer class="admin-content-footer">
            <hr>
            <p class="am-padding-left">© 2017 my-xieqing Inc. Licensed under MIT license.</p>
        </footer>
    </div>
@endsection

