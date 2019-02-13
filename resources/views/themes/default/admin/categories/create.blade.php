@extends(config('app.theme').'admin.index')

@section('admin-content')
    <div class="row">
        <article>
            <div class="form-body">
                {{ Form::open(['method' => 'POST','route' => [config('app.theme').'admin.categories.store'],'style'=>'form-horizontal']) }}
                {{ csrf_field() }}

                @include(config('app.theme').'admin.previous-page')

                <div class="form-group {{ $errors->first('title') ? 'has-error' : '' }}">
                    {!! Form::label('title', u__('admin.title')) !!}
                    {{ Form::text('title', old('title'), ['class'=>'form-control', 'placeholder'=>u__('admin.title') ]) }}
					<span class="help-block">{{ $errors->first('title') }}</span>
                </div>

                <div class="form-group">
                    {!! Form::label('slug', u__('admin.slug')) !!}
                    {{ Form::text('slug', old('slug'), ['class'=>'form-control', 'placeholder'=> u__('admin.slug') ]) }}
                </div>

                <div class="form-group">
                    {!! Form::label('parent', u__('admin.parent')) !!}
                    {{ Form::select('parent_id', $categories, old('parent_id')) }}
                </div>

                {{ Form::submit(u__('admin.save'), ['class' => 'btn btn-info']) }}
                {{ Form::close() }}

            </div>
        </article>
    </div>
@endsection