@extends(config('app.theme').'admin.index')

@section('admin-content')
    <div class="row">
        <article>
            <div class="form-body">
				{{ Form::open(['method' => 'PUT','route' => [config('app.theme').'admin.post-comments.update',$postComment->id],'style'=>'form-horizontal']) }}
                {{ csrf_field() }}

                @include(config('app.theme').'admin.previous-page')

                <div class="form-group">
                    {!! Form::label('content', u__('admin.content')) !!}
                    {{ Form::textarea('content', $postComment->content, ['class'=>'form-control', 'placeholder'=> u__('admin.content') ]) }}
                </div>

                <div class="form-group">
                    {!! Form::label('parent post', u__('admin.parent post')) !!}
                    {{ Form::text('post_id', $postComment->post_id, ['class'=>'form-control', 'placeholder'=> u__('admin.parent post') ]) }}
                </div>

                <div class="form-group">
                    {!! Form::label('parent comment', u__('admin.parent comment')) !!}
                    {{ Form::text('parent_id', $postComment->parent_id, ['class'=>'form-control', 'placeholder'=> u__('admin.parent comment') ]) }}
                </div>

                {{ Form::submit('Save', ['class' => 'btn btn-info']) }}
                {{ Form::close() }}

            </div>
        </article>
    </div>
@endsection