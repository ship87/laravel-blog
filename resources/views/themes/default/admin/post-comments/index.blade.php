@extends(config('app.theme').'admin.index')

@section('admin-content')

    @foreach ($postComments as $postComment)
        <div class="row">
            <div class="col-xs-1">
                {{$postComment->id}}
            </div>
            <div class="col-xs-1">
                <a href="{{ route(config('app.theme').'admin.post-comments.edit', $postComment->id) }}">{{ Form::submit(u__('admin.edit'), ['class' => 'btn btn-info']) }}</a>
            </div>
            <div class="col-xs-1">
				{{ Form::open(['method' => u__('admin.delete'),'route' => [config('app.theme').'admin.post-comments.destroy', $postComment->id],'style'=>'form-inline']) }}
				{{ csrf_field() }}
				{{ Form::submit(u__('admin.delete'), ['class' => 'btn btn-info','onclick'=>'confirmDelete()']) }}
				{{ Form::close() }}
            </div>
            <div class="col-xs-5">
                {{ $postComment->content }}
            </div>
            <div class="col-xs-1">
                {{ $postComment->created_user_id }}
            </div>
            <div class="col-xs-1">
                {{ $postComment->created_at }}
            </div>
        </div>
    @endforeach

    <div class="row">
        {{ $postComments->links() }}
    </div>
@endsection