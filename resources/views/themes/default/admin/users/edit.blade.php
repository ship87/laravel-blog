@extends(config('app.theme').'admin.index')

@section('admin-content')
    <div class="row">
        <article>
            <div class="form-body">
				{{ Form::open(['method' => 'POST','route' => [config('app.theme').'admin.users.store'],'style'=>'form-horizontal']) }}
                {{ csrf_field() }}

                <div class="form-group">
                    {!! Form::label('name', 'Name') !!}
                    {{ Form::text('name', $user->name, ['class'=>'form-control', 'placeholder'=>'Name' ]) }}
                </div>

                <div class="form-group">
                    {!! Form::label('email', 'Email') !!}
                    {{ Form::text('email', $user->email, ['class'=>'form-control', 'placeholder'=> 'Email' ]) }}
                </div>

                <div class="form-group">
                    {!! Form::label('password', 'Password') !!}
                    {{ Form::password('password', $user->password, ['class'=>'form-control', 'placeholder'=> 'Password' ]) }}
                </div>

                {{ Form::submit('Save', ['class' => 'btn btn-info']) }}
                {{ Form::close() }}

            </div>
        </article>
    </div>
@endsection