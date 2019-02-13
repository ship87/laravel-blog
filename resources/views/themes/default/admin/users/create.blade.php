@extends(config('app.theme').'admin.index')

@section('admin-content')
    <div class="row">
        <article>
            <div class="form-body">
				{{ Form::open(['method' => 'POST','route' => [config('app.theme').'admin.users.store'],'style'=>'form-horizontal']) }}
                {{ csrf_field() }}

                @include(config('app.theme').'admin.previous-page')

                <div class="form-group {{ $errors->first('name') ? 'has-error' : '' }}">
                    {!! Form::label('name', u__('admin.name')) !!}
                    {{ Form::text('name', old('name'), ['class'=>'form-control', 'placeholder'=>u__('admin.name') ]) }}
					<span class="help-block">{{ $errors->first('name') }}</span>
                </div>

                <div class="form-group {{ $errors->first('email') ? 'has-error' : '' }}">
                    {!! Form::label('email', u__('admin.email')) !!}
                    {{ Form::text('email', old('email'), ['class'=>'form-control', 'placeholder'=> u__('admin.email') ]) }}
					<span class="help-block">{{ $errors->first('email') }}</span>
                </div>

                <div class="form-group {{ $errors->first('password') ? 'has-error' : '' }}">
                    {!! Form::label('password', u__('admin.password')) !!}
                    {{ Form::password('password', old('password'), ['class'=>'form-control', 'placeholder'=> u__('admin.password') ]) }}
					<span class="help-block">{{ $errors->first('password') }}</span>
                </div>

                {{ Form::submit(u__('admin.save'), ['class' => 'btn btn-info']) }}
                {{ Form::close() }}

            </div>
        </article>
    </div>
@endsection