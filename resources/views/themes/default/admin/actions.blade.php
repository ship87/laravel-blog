@if ($canEdit)
    <div class="col-xs-1">
        <a href="{{ route(config('app.theme').'admin.'.$dataName.'.edit', $data->id) }}">{{ Form::submit(u__('admin.edit'), ['class' => 'btn btn-info']) }}</a>
    </div>
@endif
@if ($canDelete)
    <div class="col-xs-1">
        {{ Form::open(['method' => u__('admin.delete'),'route' => [config('app.theme').'admin.'.$dataName.'.destroy', $data->id],'style'=>'form-inline']) }}
        {{ csrf_field() }}
        {{ Form::submit(u__('admin.delete'), ['class' => 'btn btn-info','onclick'=>'confirmDelete()']) }}
        {{ Form::close() }}
    </div>
@endif