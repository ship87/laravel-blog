@extends(config('app.theme').'admin.index')

@section('admin-content')
    <div class="row">
        <article>
            <div class="form-body">
				{{ Form::open(['method' => 'PUT','route' => [config('app.theme').'admin.users.update', $user->id],'style'=>'form-horizontal']) }}
                {{ csrf_field() }}

                <div class="form-group">
                    {!! Form::label('name', u__('admin.name')) !!}
                    {{ Form::text('name', $user->name, ['class'=>'form-control', 'placeholder'=>u__('admin.name') ]) }}
                </div>

                <div class="form-group">
                    {!! Form::label('email', u__('admin.email')) !!}
                    {{ Form::text('email', $user->email, ['class'=>'form-control', 'placeholder'=> u__('admin.email') ]) }}
                </div>

                {{ Form::submit('Save', ['class' => 'btn btn-info']) }}
                {{ Form::close() }}

            </div>
        </article>
    </div>
@endsection