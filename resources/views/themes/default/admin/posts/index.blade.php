@extends(config('app.theme').'admin.index')

@section('admin-content')

    @foreach ($posts as $post)
        <div class="row">
            <div class="col-xs-1">
                {{$post->id}}
            </div>
            <div class="col-xs-1">
                <a href="{{ route(config('app.theme').'admin.posts.edit', $post->id) }}">{{ Form::submit(u__('admin.edit'), ['class' => 'btn btn-info']) }}</a>
            </div>
            <div class="col-xs-1">
                {{ Form::open(['method' => u__('admin.delete'),'route' => [config('app.theme').'admin.posts.destroy', $post->id],'style'=>'form-inline']) }}
                {{ csrf_field() }}
                {{ Form::submit(u__('admin.delete'), ['class' => 'btn btn-info','onclick'=>'confirmDelete()']) }}
                {{ Form::close() }}
            </div>
            <div class="col-xs-5">
                {{ $post->title }}
            </div>
            <div class="col-xs-1">
                {{ $post->created_user_id }}
            </div>
            <div class="col-xs-1">
                {{ $post->created_at }}
            </div>
            <div class="col-xs-1">
                {{ $post->updated_at }}
            </div>
        </div>
    @endforeach

    <div class="row">
        {{ $posts->links() }}
    </div>

@endsection