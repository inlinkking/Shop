@extends('log-viewer::_template.master')

@section('content')
    <h1 class="page-header">时间 [{{ $log->date }}]</h1>

    <div class="row">
        <div class="col-md-2">
            @include('log-viewer::_partials.menu')
        </div>
        <div class="col-md-10">
            {{-- Log Details --}}
            <div class="panel panel-default">
                <div class="panel-heading">
                    错误提示 :

                    <div class="group-btns pull-right">
                        <a href="{{ route('log-viewer::logs.download', [$log->date]) }}" class="btn btn-xs btn-success">
                            <i class="fa fa-download"></i> 下载
                        </a>
                        <a href="#delete-log-modal" class="btn btn-xs btn-danger" data-toggle="modal">
                            <i class="fa fa-trash-o"></i> 删除
                        </a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-condensed">
                        <thead>
                        <tr>
                            <td>位置 :</td>
                            <td colspan="5">{{ $log->getPath() }}</td>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>数量 : </td>
                            <td>
                                <span class="label label-primary">{{ $entries->total() }}</span>
                            </td>
                            <td>字体 :</td>
                            <td>
                                <span class="label label-primary">{{ $log->size() }}</span>
                            </td>
                            <td>新增时间 :</td>
                            <td>
                                <span class="label label-primary">{{ $log->createdAt() }}</span>
                            </td>
                            <td>更新时间 :</td>
                            <td>
                                <span class="label label-primary">{{ $log->updatedAt() }}</span>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="panel-footer">
                    {{-- Search --}}
                    <form action="{{ route('log-viewer::logs.search', [$log->date, $level]) }}" method="GET">
                        <div class=form-group">
                            <div class="input-group">
                                <input id="query" name="query" class="form-control"  value="{!! request('query') !!}" placeholder="">
                                <span class="input-group-btn">
                                    @if (request()->has('query'))
                                        <a href="{{ route('log-viewer::logs.show', [$log->date]) }}" class="btn btn-default">
                                            <span class="fa fa-remove"></span>
                                        </a>
                                    @endif
                                    <button id="search-btn" class="btn btn-primary"><span class="fa fa-search"></span></button>
                                </span>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Log Entries --}}
            <div class="panel panel-default">
                @if ($entries->hasPages())
                    <div class="panel-heading">
                        {!! $entries->appends(compact('query'))->render() !!}

                        <span class="label label-info pull-right">
                            当前 {!! $entries->currentPage() !!} 共 {!! $entries->lastPage() !!}
                        </span>
                    </div>
                @endif

                <div class="table-responsive">
                    <table id="entries" class="table table-condensed">
                        <thead>
                        <tr>
                            <th>ENV</th>
                            <th style="width: 120px;">信息</th>
                            <th style="width: 65px;">时间</th>
                            <th>错误信息</th>
                            <th class="text-right">操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($entries as $key => $entry)
                            <tr>
                                <td>
                                    <span class="label label-env">{{ $entry->env }}</span>
                                </td>
                                <td>
                                        <span class="level level-{{ $entry->level }}">
                                            {!! $entry->level() !!}
                                        </span>
                                </td>
                                <td>
                                        <span class="label label-default">
                                            {{ $entry->datetime->format('H:i:s') }}
                                        </span>
                                </td>
                                <td>
                                    <p>{{ $entry->header }}</p>
                                </td>
                                <td class="text-right">
                                    @if ($entry->hasStack())
                                        <a class="btn btn-xs btn-default" role="button" data-toggle="collapse" href="#log-stack-{{ $key }}" aria-expanded="false" aria-controls="log-stack-{{ $key }}">
                                            <i class="fa fa-toggle-on"></i> 展开
                                        </a>
                                    @endif
                                </td>
                            </tr>
                            @if ($entry->hasStack())
                                <tr>
                                    <td colspan="5" class="stack">
                                        <div class="stack-content collapse" id="log-stack-{{ $key }}">
                                            {!! $entry->stack() !!}
                                        </div>
                                    </td>
                                </tr>
                            @endif
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">
                                    <span class="label label-default">{{ trans('log-viewer::general.empty-logs') }}</span>
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>

                @if ($entries->hasPages())
                    <div class="panel-footer">
                        {!! $entries->appends(compact('query'))->render() !!}

                        <span class="label label-info pull-right">
                            当前 {!! $entries->currentPage() !!} 共 {!! $entries->lastPage() !!}
                        </span>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@section('modals')
    {{-- DELETE MODAL --}}
    <div id="delete-log-modal" class="modal fade">
        <div class="modal-dialog">
            <form id="delete-log-form" action="{{ route('log-viewer::logs.delete') }}" method="POST">
                <input type="hidden" name="_method" value="DELETE">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="date" value="{{ $log->date }}">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title">确定删除么？</h4>
                    </div>
                    <div class="modal-body">
                        <p> 你确定你想 <span class="label label-danger"> 删 除 </span> 此日志文件 <span class="label label-primary">{{ $log->date }}</span> ?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-default pull-left" data-dismiss="modal">再想想</button>
                        <button type="submit" class="btn btn-sm btn-danger" data-loading-text="Loading&hellip;">心意已决</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(function () {
            var deleteLogModal = $('div#delete-log-modal'),
                deleteLogForm  = $('form#delete-log-form'),
                submitBtn      = deleteLogForm.find('button[type=submit]');

            deleteLogForm.on('submit', function(event) {
                event.preventDefault();
                submitBtn.button('loading');

                $.ajax({
                    url:      $(this).attr('action'),
                    type:     $(this).attr('method'),
                    dataType: 'json',
                    data:     $(this).serialize(),
                    success: function(data) {
                        submitBtn.button('reset');
                        if (data.result === 'success') {
                            deleteLogModal.modal('hide');
                            location.replace("{{ route('log-viewer::logs.list') }}");
                        }
                        else {
                            alert('OOPS ! This is a lack of coffee exception !')
                        }
                    },
                    error: function(xhr, textStatus, errorThrown) {
                        alert('AJAX ERROR ! Check the console !');
                        console.error(errorThrown);
                        submitBtn.button('reset');
                    }
                });

                return false;
            });

            @unless (empty(log_styler()->toHighlight()))
            $('.stack-content').each(function() {
                var $this = $(this);
                var html = $this.html().trim()
                    .replace(/({!! join(log_styler()->toHighlight(), '|') !!})/gm, '<strong>$1</strong>');

                $this.html(html);
            });
            @endunless
        });
    </script>
@endsection