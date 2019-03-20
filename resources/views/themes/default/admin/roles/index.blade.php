@extends(config('app.theme').'admin.index')

@section('admin-content')

    @include(config('app.theme').'admin.header', ['dataName'=>'roles','dataHeader'=>['id'=>1,'actions'=>2,'title'=>5]])

    @foreach ($roles as $role)
        <div class="row">
            <div class="col-xs-1">
                {{$role->id}}
            </div>

            @include(config('app.theme').'admin.actions', ['dataName'=>'roles','data'=>$role,'canEdit'=>$canEdit,'canDelete'=>$canDelete])

            <div class="col-xs-5">
                {{ $role->title }}
            </div>
        </div>
    @endforeach

    <div class="row">
        {{ $roles->links() }}
    </div>

@endsection