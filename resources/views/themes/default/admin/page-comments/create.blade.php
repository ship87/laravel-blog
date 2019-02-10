@extends(config('app.theme').'admin.index')

@section('admin-content')
    <div class="row">
        <article>
            <div class="form-body">
                {{ Form::open(['method' => 'POST','route' => [config('app.theme').'admin.page-comments.store'],'style'=>'form-horizontal']) }}
                {{ csrf_field() }}

                @include(config('app.theme').'admin.previous-page')

                <div class="form-group">
                    {!! Form::label('content', u__('admin.content')) !!}
                    {{ Form::textarea('content', old('content'), ['class'=>'form-control', 'placeholder'=> u__('admin.content') ]) }}
                </div>

                <div class="form-group">
                    {!! Form::label('parent page', u__('admin.parent page')) !!}
                    {{ Form::text('page_id', old('page_id'), ['class'=>'form-control', 'placeholder'=> u__('admin.parent page') ]) }}
                </div>

                <div class="form-group">
                    {!! Form::label('parent comment', u__('admin.parent comment')) !!}
                    {{ Form::text('parent_id', old('parent_id'), ['class'=>'form-control', 'placeholder'=> u__('admin.parent comment') ]) }}
                </div>

                {{ Form::submit('Save', ['class' => 'btn btn-info']) }}
                {{ Form::close() }}

            </div>
        </article>
    </div>
@endsection