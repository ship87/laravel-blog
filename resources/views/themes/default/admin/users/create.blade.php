@extends(config('app.theme').'admin.index')

@section('admin-content')
    <div class="row">
        <article>
            <div class="form-body">
				{{ Form::open(['method' => 'POST','route' => [config('app.theme').'admin.users.store'],'style'=>'form-horizontal']) }}
                {{ csrf_field() }}

                @include(config('app.theme').'admin.previous-page')

                <div class="form-group">
                    {!! Form::label('name', u__('admin.name')) !!}
                    {{ Form::text('name', old('name'), ['class'=>'form-control', 'placeholder'=>u__('admin.name') ]) }}
                </div>

                <div class="form-group">
                    {!! Form::label('email', u__('admin.email')) !!}
                    {{ Form::text('email', old('email'), ['class'=>'form-control', 'placeholder'=> u__('admin.email') ]) }}
                </div>

                <div class="form-group">
                    {!! Form::label('password', u__('admin.password')) !!}
                    {{ Form::password('password', old('password'), ['class'=>'form-control', 'placeholder'=> u__('admin.password') ]) }}
                </div>

                {{ Form::submit('Save', ['class' => 'btn btn-info']) }}
                {{ Form::close() }}

            </div>
        </article>
    </div>
@endsection