@extends(config('app.theme').'admin.index')

@section('admin-content')
    <div class="row">
        <article>
            <div class="form-body">
				{{ Form::open(['method' => 'PUT','route' => [config('app.theme').'admin.posts.update',$post->id],'style'=>'form-horizontal']) }}
                {{ csrf_field() }}

                <div class="form-group">
                    {!! Form::label('title', u__('admin.title')) !!}
                    {{ Form::text('title', $post->title, ['class'=>'form-control', 'placeholder'=>u__('admin.title') ]) }}
                </div>

                <div class="form-group">
                    {!! Form::label('slug', u__('admin.slug')) !!}
                    {{ Form::text('text', $post->slug, ['class'=>'form-control', 'placeholder'=> u__('admin.slug') ]) }}
                </div>

                <div class="form-group">
                    {!! Form::label('content', u__('admin.content')) !!}
                    {{ Form::textarea('content', $post->content, ['class'=>'form-control', 'placeholder'=> u__('admin.content') ]) }}
                </div>

                <div class="form-group">
                    {!! Form::label('no_comments', u__('admin.no comments')) !!}
                    {{ Form::select('no_comments', ['Y' => 'Yes', 'N' => 'No'], $post->no_comments) }}
                </div>

                {{ Form::submit('Save', ['class' => 'btn btn-info']) }}
                {{ Form::close() }}

            </div>
        </article>
    </div>
@endsection