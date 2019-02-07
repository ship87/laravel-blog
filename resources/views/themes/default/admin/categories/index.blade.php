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
    @foreach ($categories as $category)
            <div class="row">
            <div class="col-xs-1">
                {{$category->id}}
            </div>
            <div class="col-xs-1">
                <a href="{{ route(config('app.theme').'admin.categories.edit', $category->id) }}">{{ Form::submit('Edit', ['class' => 'btn btn-info']) }}</a>
            </div>
            <div class="col-xs-1">
				{{ Form::open(['method' => 'DELETE','route' => [config('app.theme').'admin.categories.destroy', $category->id],'style'=>'form-inline']) }}
					{{ csrf_field() }}
					{{ Form::submit('Delete', ['class' => 'btn btn-info','onclick'=>'confirmDelete()']) }}
				{{ Form::close() }}
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