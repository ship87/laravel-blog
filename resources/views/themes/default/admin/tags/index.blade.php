@extends(config('app.theme').'admin.index')

@section('admin-content')

    @foreach ($tags as $tag)
        <div class="row">
            <div class="col-xs-1">
                {{$tag->id}}
            </div>
            <div class="col-xs-1">
                <a href="{{ route(config('app.theme').'admin.tags.edit', $tag->id) }}">Edit</a>
            </div>
            <div class="col-xs-1">
                <a href="{{ route(config('app.theme').'admin.tags.destroy', $tag->id) }}">Delete</a>
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