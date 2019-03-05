@extends(config('app.theme').'admin.index')

@section('admin-content')
    @foreach ($actions as $action)
            <div class="row">
            <div class="col-xs-1">
                {{$action->id}}
            </div>
            <div class="col-xs-1">
                <a href="{{ route(config('app.theme').'admin.permissions.edit', $permission->id) }}">{{ Form::submit(u__('admin.edit'), ['class' => 'btn btn-info']) }}</a>
            </div>
            <div class="col-xs-1">
				{{ Form::open(['method' => u__('admin.delete'),'route' => [config('app.theme').'admin.permissions.destroy', $permission->id],'style'=>'form-inline']) }}
					{{ csrf_field() }}
					{{ Form::submit(u__('admin.delete'), ['class' => 'btn btn-info','onclick'=>'confirmDelete()']) }}
				{{ Form::close() }}
            </div>
            <div class="col-xs-5">
                {{ $permission->title }}
            </div>
    </div>
    @endforeach

    <div class="row">
        {{ $permissions->links() }}
    </div>

@endsection