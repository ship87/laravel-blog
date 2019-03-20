@extends(config('app.theme').'admin.index')

@section('admin-content')

    @include(config('app.theme').'admin.header', ['dataName'=>'post comments','dataHeader'=>['id'=>1,'actions'=>2,'content'=>3,'created'=>1,'updated'=>1,'created_at'=>1]])

    @foreach ($postComments as $postComment)
        <div class="row">
            <div class="col-xs-1">
                {{$postComment->id}}
            </div>

            @include(config('app.theme').'admin.actions', ['dataName'=>'post-comments','data'=>$postComment,'canEdit'=>$canEdit,'canDelete'=>$canDelete])

            <div class="col-xs-3">
                {{ $postComment->content }}
            </div>
            <div class="col-xs-1">
                {{ $postComment->createdUser->name }}
            </div>
            <div class="col-xs-1">
                {{ $postComment->updatedUser->name }}
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