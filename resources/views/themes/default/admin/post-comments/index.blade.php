@extends(config('app.theme').'admin.index')

@section('admin-content')

    @foreach ($postComments as $postComment)
        <div class="row">
            <div class="col-xs-1">
                {{$postComment->id}}
            </div>

            @include(config('app.theme').'admin.actions', ['dataName'=>'post-comments','data'=>$postComment,'canEdit'=>$canEdit,'canDelete'=>$canDelete])

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