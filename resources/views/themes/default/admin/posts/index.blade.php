@extends(config('app.theme').'admin.index')

@section('admin-content')

    @include(config('app.theme').'admin.header', ['dataHeader'=>['id'=>1,'actions'=>2,'title'=>3,'created_user'=>1,'updated_user'=>1,'created_at'=>1,'updated_at'=>1]])

    @foreach ($posts as $post)
        <div class="row">
            <div class="col-xs-1">
                {{$post->id}}
            </div>

            @include(config('app.theme').'admin.actions', ['dataName'=>'posts','data'=>$post,'canEdit'=>$canEdit,'canDelete'=>$canDelete])

            <div class="col-xs-3">
                {{ $post->title }}
            </div>
            <div class="col-xs-1">
                {{ $post->createdUser->name }}
            </div>
            <div class="col-xs-1">
                {{ $post->updatedUser->name }}
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