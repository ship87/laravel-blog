@extends(config('app.theme').'admin.index')

@section('admin-content')
    <div class="row">
        <article>
            <div class="form-body">
				{{ Form::open(['method' => 'POST','route' => [config('app.theme').'admin.posts.store'],'style'=>'form-horizontal']) }}
                {{ csrf_field() }}

                <div class="form-group">
                    {!! Form::label('title', 'Title') !!}
                    {{ Form::text('title', old('title'), ['class'=>'form-control', 'placeholder'=>'Title' ]) }}
                </div>

                <div class="form-group">
                    {!! Form::label('slug', 'Slug') !!}
                    {{ Form::text('slug', old('slug'), ['class'=>'form-control', 'placeholder'=> 'Slug' ]) }}
                </div>

                <div class="form-group">
                    {!! Form::label('content', 'Content') !!}
                    {{ Form::textarea('content', old('content'), ['class'=>'form-control', 'placeholder'=> 'Content' ]) }}
                </div>

                <div class="form-group">
                    {!! Form::label('no_comments', u__('admin.no comments')) !!}
                    {{ Form::select('no_comments', ['Y' => 'Yes', 'N' => 'No'], old('no_comments')?old('no_comments'):'N') }}
                </div>

                {{ Form::submit('Save', ['class' => 'btn btn-info']) }}
                {{ Form::close() }}

            </div>
        </article>
    </div>
@endsection