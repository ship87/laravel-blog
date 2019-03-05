@extends(config('app.theme').'admin.index')

@section('admin-content')
    <div class="row">
        <div class="col-xs-1">
            id
        </div>
        <div class="col-xs-1">
            action
        </div>
        <div class="col-xs-1">
            action
        </div>
        <div class="col-xs-5">
            title
        </div>
    </div>
    @foreach ($roles as $role)
            <div class="row">
            <div class="col-xs-1">
                {{$role->id}}
            </div>
            <div class="col-xs-1">
                <a href="{{ route(config('app.theme').'admin.roles.edit', $role->id) }}">{{ Form::submit(u__('admin.edit'), ['class' => 'btn btn-info']) }}</a>
            </div>
            <div class="col-xs-1">
				{{ Form::open(['method' => u__('admin.delete'),'route' => [config('app.theme').'admin.roles.destroy', $role->id],'style'=>'form-inline']) }}
					{{ csrf_field() }}
					{{ Form::submit(u__('admin.delete'), ['class' => 'btn btn-info','onclick'=>'confirmDelete()']) }}
				{{ Form::close() }}
            </div>
            <div class="col-xs-5">
                {{ $role->title }}
            </div>
    </div>
    @endforeach

    <div class="row">
        {{ $roles->links() }}
    </div>

@endsection