@extends(config('app.theme').'admin.index')

@section('admin-content')

    @foreach ($categories as $category)
        <div class="row">
            <div class="col-xs-1">
                {{$category->id}}
            </div>
            <div class="col-xs-1">
                <a href="{{ route(config('app.theme').'admin.categories.edit', $category->id) }}">Edit</a>
            </div>
            <div class="col-xs-1">
                <a href="{{ route(config('app.theme').'admin.categories.destroy', $category->id) }}">Delete</a>
            </div>
            <div class="col-xs-5">
                {{ $category->title }}
            </div>
        </div>
    @endforeach

    <div class="row">
        {{ $categories->links() }}
    </div>

@endsection