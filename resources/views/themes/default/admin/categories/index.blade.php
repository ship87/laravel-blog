@extends(config('app.theme').'admin.index')

@section('admin-content')
    @foreach ($categories as $category)
        <div class="row">
            <div class="col-xs-1">
                {{$category->id}}
            </div>

            @include(config('app.theme').'admin.actions', ['dataName'=>'categories','data'=>$category,'canEdit'=>$canEdit,'canDelete'=>$canDelete])

            <div class="col-xs-5">
                {{ $category->title }}
            </div>
        </div>
    @endforeach

    <div class="row">
        {{ $categories->links() }}
    </div>

@endsection