@extends(config('app.theme').'admin.index')

@section('admin-content')

    @foreach ($pages as $page)
        <div class="row">
            <div class="col-xs-1">
                {{$page->id}}
            </div>
            <div class="col-xs-1">
                <a href="{{ route(config('app.theme').'admin.pages.edit', $page->id) }}">{{ Form::submit(u__('admin.edit'), ['class' => 'btn btn-info']) }}</a>
            </div>
            <div class="col-xs-1">
                {{ Form::open(['method' => u__('admin.delete'),'route' => [config('app.theme').'admin.pages.destroy', $page->id],'style'=>'form-inline']) }}
                {{ csrf_field() }}
                {{ Form::submit(u__('admin.delete'), ['class' => 'btn btn-info','onclick'=>'confirmDelete()']) }}
                {{ Form::close() }}
            </div>
            <div class="col-xs-5">
                {{ $page->title }}
            </div>
            <div class="col-xs-1">
                {{ $page->created_user_id }}
            </div>
            <div class="col-xs-1">
                {{ $page->created_at }}
            </div>
            <div class="col-xs-1">
                {{ $page->updated_at }}
            </div>
        </div>
    @endforeach

    <div class="row">
        {{ $pages->links() }}
    </div>

@endsection