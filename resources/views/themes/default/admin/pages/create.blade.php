@extends(config('app.theme').'admin.index')

@section('admin-content')
    <div class="row">
        <article>
            <div class="form-body">
				{{ Form::open(['method' => 'POST','route' => [config('app.theme').'admin.pages.store'],'style'=>'form-horizontal']) }}
                {{ csrf_field() }}

                <div class="form-group">
                    {!! Form::label('title', 'Title') !!}
                    {{ Form::text('title', null, ['class'=>'form-control', 'placeholder'=>'Title' ]) }}
                </div>

                <div class="form-group">
                    {!! Form::label('slug', 'Slug') !!}
                    {{ Form::text('text', null, ['class'=>'form-control', 'placeholder'=> 'Slug' ]) }}
                </div>

                <div class="form-group">
                    {!! Form::label('content', 'Content') !!}
                    {{ Form::textarea('content', null, ['class'=>'form-control', 'placeholder'=> 'Content' ]) }}
                </div>

                <div class="form-group">
                    {!! Form::label('no_comments', 'No comments') !!}
                    {{ Form::select('no_comments', ['Y' => 'Yes', 'N' => 'No'], 'N') }}
                </div>

                <div class="form-group">
                    {!! Form::label('parent', 'Parent') !!}
                    {{ Form::text('parent_id', null, ['class'=>'form-control', 'placeholder'=> 'Parent' ]) }}
                </div>

                {{ Form::submit('Save', ['class' => 'btn btn-info']) }}
                {{ Form::close() }}

            </div>
        </article>
    </div>
@endsection