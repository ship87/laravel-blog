@extends(config('app.theme').'admin.index')

@section('admin-content')

    @include(config('app.theme').'admin.header', ['dataName'=>'page comments','dataHeader'=>['id'=>1,'actions'=>2,'content'=>3,'created'=>1,'updated'=>1,'created_at'=>1]])

    @foreach ($pageComments as $pageComment)
        <div class="row">
            <div class="col-xs-1">
                {{$pageComment->id}}
            </div>

            @include(config('app.theme').'admin.actions', ['dataName'=>'page-comments','data'=>$pageComment,'canEdit'=>$canEdit,'canDelete'=>$canDelete])

            <div class="col-xs-3">
                {{ $pageComment->content }}
            </div>
            <div class="col-xs-1">
                {{ $pageComment->createdUser->name }}
            </div>
            <div class="col-xs-1">
                {{ $pageComment->updatedUser->name }}
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