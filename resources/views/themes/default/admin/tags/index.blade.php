@extends(config('app.theme').'admin.index')

@section('admin-content')

    @foreach ($tags as $tag)
        <div class="row">
            <div class="col-xs-1">
                {{$tag->id}}
            </div>
            <div class="col-xs-1">
                <a href="{{ route(config('app.theme').'admin.tags.edit', $tag->id) }}">{{ Form::submit(u__('admin.edit'), ['class' => 'btn btn-info']) }}</a>
            </div>
            <div class="col-xs-1">
				{{ Form::open(['method' => u__('admin.delete'),'route' => [config('app.theme').'admin.tags.destroy', $tag->id],'style'=>'form-inline']) }}
				{{ csrf_field() }}
				{{ Form::submit(u__('admin.delete'), ['class' => 'btn btn-info','onclick'=>'confirmDelete()']) }}
				{{ Form::close() }}
            </div>
            <div class="col-xs-5">
                {{ $tag->name }}
            </div>
        </div>
    @endforeach

    <div class="row">
        {{ $tags->links() }}
    </div>

@endsection