@extends(config('app.theme').'admin.index')

@section('admin-content')

    @foreach ($pageComments as $pageComment)
        <div class="row">
            <div class="col-xs-1">
                {{$pageComment->id}}
            </div>
            <div class="col-xs-1">
                <a href="{{ route(config('app.theme').'admin.page-comments.edit', $pageComment->id) }}">{{ Form::submit('Edit', ['class' => 'btn btn-info']) }}</a>
            </div>
            <div class="col-xs-1">
				{{ Form::open(['method' => 'DELETE','route' => [config('app.theme').'admin.page-comments.destroy', $pageComment->id],'style'=>'form-inline']) }}
				{{ csrf_field() }}
				{{ Form::submit('Delete', ['class' => 'btn btn-info']) }}
				{{ Form::close() }}
            </div>
            <div class="col-xs-5">
                {{ $pageComment->content }}
            </div>
            <div class="col-xs-1">
                {{ $pageComment->created_user_id }}
            </div>
            <div class="col-xs-1">
                {{ $pageComment->created_at }}
            </div>
        </div>
    @endforeach

    <div class="row">
        {{ $pageComments->links() }}
    </div>

@endsection