@extends(config('app.theme').'admin.index')

@section('admin-content')

    @foreach ($tags as $tag)
        <div class="row">
            <div class="col-xs-1">
                {{$tag->id}}
            </div>

            @include(config('app.theme').'admin.actions', ['dataName'=>'tags','data'=>$tag,'canEdit'=>$canEdit,'canDelete'=>$canDelete])

            <div class="col-xs-5">
                {{ $tag->title }}
            </div>
        </div>
    @endforeach

    <div class="row">
        {{ $tags->links() }}
    </div>

@endsection