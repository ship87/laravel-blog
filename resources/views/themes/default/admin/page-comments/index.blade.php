@extends(config('app.theme').'admin.index')

@section('admin-content')

    @foreach ($pageComments as $pageComment)
        <div class="row">
            <div class="col-xs-1">
                {{$pageComment->id}}
            </div>
            <div class="col-xs-1">
                <a href="{{ route(config('app.theme').'admin.page-comments.edit', $pageComment->id) }}">Edit</a>
            </div>
            <div class="col-xs-1">
                <a href="{{ route(config('app.theme').'admin.page-comments.destroy', $pageComment->id) }}">Delete</a>
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