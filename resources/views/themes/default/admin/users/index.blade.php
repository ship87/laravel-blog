@extends(config('app.theme').'admin.index')

@section('admin-content')

    @include(config('app.theme').'admin.header', ['dataHeader'=>['id'=>1,'actions'=>2,'name'=>3,'email'=>3]])

    @foreach ($users as $user)
        <div class="row">
            <div class="col-xs-1">
                {{$user->id}}
            </div>

            @include(config('app.theme').'admin.actions', ['dataName'=>'users','data'=>$user,'canEdit'=>$canEdit,'canDelete'=>$canDelete])

            <div class="col-xs-3">
                {{ $user->name }}
            </div>
            <div class="col-xs-3">
                {{ $user->email }}
            </div>
        </div>
    @endforeach

    <div class="row">
        {{ $users->links() }}
    </div>
@endsection