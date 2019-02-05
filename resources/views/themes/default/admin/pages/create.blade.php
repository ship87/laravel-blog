@extends(config('app.theme').'admin.index')

@section('admin-content')
    <div class="row">
        <article>
            <div class="form-body">
				{{ Form::open(['method' => 'POST','route' => [config('app.theme').'admin.pages.store'],'style'=>'form-horizontal']) }}
                {{ csrf_field() }}

                <div class="form-group">
                    {!! Form::label('title', u__('admin.title')) !!}
                    {{ Form::text('title', old('title'), ['class'=>'form-control', 'placeholder'=>u__('admin.title') ]) }}
                </div>

                <div class="form-group">
                    {!! Form::label('slug', u__('admin.slug')) !!}
                    {{ Form::text('slug', old('slug'), ['class'=>'form-control', 'placeholder'=> u__('admin.slug') ]) }}
                </div>

                <div class="form-group">
                    {!! Form::label('content', u__('admin.content')) !!}
                    {{ Form::textarea('content', old('content'), ['class'=>'form-control', 'placeholder'=> u__('admin.content'),'id'=>'editor' ]) }}
                </div>

                <div class="form-group">
                    {!! Form::label('no_comments', u__('admin.no comments')) !!}
                    {{ Form::select('no_comments', ['Y' => 'Yes', 'N' => 'No'], is_null(old('no_comments'))?'N':old('no_comments')) }}
                </div>

                <div class="form-group">
                    {!! Form::label('parent', u__('admin.parent')) !!}
                    {{ Form::text('parent_id', old('parent_id'), ['class'=>'form-control', 'placeholder'=> u__('admin.parent') ]) }}
                </div>

                {{ Form::submit('Save', ['class' => 'btn btn-info']) }}
                {{ Form::close() }}

            </div>
        </article>
    </div>
@endsection