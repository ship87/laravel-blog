@extends(config('app.theme').'admin.index')

@section('admin-content')

    @foreach ($posts as $post)
        <div class="row">
            <div class="col-xs-1">
                {{$post->id}}
            </div>

            @include(config('app.theme').'admin.actions', ['dataName'=>'posts','data'=>$post,'canEdit'=>$canEdit,'canDelete'=>$canDelete])

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