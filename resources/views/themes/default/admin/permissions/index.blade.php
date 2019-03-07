@extends(config('app.theme').'admin.index')

@section('admin-content')
    @foreach ($permissions as $permission)
            <div class="row">
            <div class="col-xs-1">
                {{$permission->id}}
            </div>

            @include(config('app.theme').'admin.actions', ['dataName'=>'permissions','data'=>$permission,'canEdit'=>$canEdit,'canDelete'=>$canDelete])

            <div class="col-xs-5">
                {{ $permission->title }}
            </div>
    </div>
    @endforeach

    <div class="row">
        {{ $permissions->links() }}
    </div>

@endsection