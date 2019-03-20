@extends(config('app.theme').'admin.index')

@section('admin-content')

    @include(config('app.theme').'admin.header', ['dataName'=>'pages','dataHeader'=>['id'=>1,'actions'=>2,'title'=>3,'created'=>1,'updated'=>1,'created_at'=>1,'updated_at'=>1]])

    @foreach ($pages as $page)
        <div class="row">
            <div class="col-xs-1">
                {{$page->id}}
            </div>

            @include(config('app.theme').'admin.actions', ['dataName'=>'pages','data'=>$page,'canEdit'=>$canEdit,'canDelete'=>$canDelete])

            <div class="col-xs-3">
                {{ $page->title }}
            </div>
            <div class="col-xs-1">
                {{ $page->createdUser->name }}
            </div>
            <div class="col-xs-1">
                {{ $page->updatedUser->name }}
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