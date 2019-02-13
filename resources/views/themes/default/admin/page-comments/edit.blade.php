@extends(config('app.theme').'admin.index')

@section('admin-content')
    <div class="row">
        <article>
            <div class="form-body">
                {{ Form::open(['method' => 'PUT','route' => [config('app.theme').'admin.page-comments.update', $pageComment->id],'style'=>'form-horizontal']) }}
                {{ csrf_field() }}

                @include(config('app.theme').'admin.previous-page')

                <div class="form-group {{ $errors->first('content') ? 'has-error' : '' }}">
                    {!! Form::label('content', u__('admin.content')) !!}
                    {{ Form::textarea('content', $pageComment->content, ['class'=>'form-control', 'placeholder'=> u__('admin.content') ]) }}
					<span class="help-block">{{ $errors->first('content') }}</span>
                </div>

                {{ Form::submit(u__('admin.save'), ['class' => 'btn btn-info']) }}
                {{ Form::close() }}

            </div>
        </article>
    </div>
@endsection