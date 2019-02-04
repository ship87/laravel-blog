@extends(config('app.theme').'admin.index')

@section('admin-content')
    <div class="row">
        <article>
            <div class="form-body">
				{{ Form::open(['method' => 'POST','route' => [config('app.theme').'admin.pages.store'],'style'=>'form-horizontal']) }}
                {{ csrf_field() }}

                <div class="form-group">
                    {!! Form::label('title', 'Title') !!}
                    {{ Form::text('title', $page->title, ['class'=>'form-control', 'placeholder'=>'Title' ]) }}
                </div>

                <div class="form-group">
                    {!! Form::label('slug', 'Slug') !!}
                    {{ Form::text('text', $page->slug, ['class'=>'form-control', 'placeholder'=> 'Slug' ]) }}
                </div>

                <div class="form-group">
                    {!! Form::label('content', 'Content') !!}
                    {{ Form::textarea('content', $page->content, ['class'=>'form-control', 'placeholder'=> 'Content' ]) }}
                </div>

                <div class="form-group">
                    {!! Form::label('no_comments', 'No comments') !!}
                    {{ Form::select('no_comments', ['Y' => 'Yes', 'N' => 'No'], $page->no_comments) }}
                </div>

                <div class="form-group">
                    {!! Form::label('parent', 'Parent') !!}
                    {{ Form::text('parent_id', $page->parent_id, ['class'=>'form-control', 'placeholder'=> 'Parent' ]) }}
                </div>

                {{ Form::submit('Save', ['class' => 'btn btn-info']) }}
                {{ Form::close() }}

            </div>
        </article>
    </div>
@endsection