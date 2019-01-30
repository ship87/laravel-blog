@extends(config('app.theme').'admin.index')

@section('admin-content')
    <div class="row">
        <article>
            <div class="form-body">

                {{ csrf_field() }}

                <div class="form-group">
                    {!! Form::label('title', 'Title') !!}
                    {{ Form::text('title', null, ['class'=>'form-control', 'placeholder'=>'Title' ]) }}
                </div>

                <div class="form-group">
                    {!! Form::label('content', 'Content') !!}
                    {{ Form::textarea('content', null, ['class'=>'form-control', 'placeholder'=> 'Content' ]) }}
                </div>

                <div class="form-group">
                    {!! Form::label('parent post', 'Parent post') !!}
                    {{ Form::text('post_id', null, ['class'=>'form-control', 'placeholder'=> 'Parent post' ]) }}
                </div>

                <div class="form-group">
                    {!! Form::label('parent comment', 'Parent comment') !!}
                    {{ Form::text('parent_id', null, ['class'=>'form-control', 'placeholder'=> 'Parent comment' ]) }}
                </div>

                {{ Form::submit('Save', ['class' => 'btn btn-info']) }}
                {{ Form::close() }}

            </div>
        </article>
    </div>
@endsection