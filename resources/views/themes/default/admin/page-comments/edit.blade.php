@extends(config('app.theme').'admin.index')

@section('admin-content')
    <div class="row">
        <article>
            <div class="form-body">
                {{ Form::open(['method' => 'POST','route' => [config('app.theme').'admin.page-comments.store'],'style'=>'form-horizontal']) }}
                {{ csrf_field() }}

                <div class="form-group">
                    {!! Form::label('content', 'Content') !!}
                    {{ Form::textarea('content', $pageComment->content, ['class'=>'form-control', 'placeholder'=> 'Content' ]) }}
                </div>

                <div class="form-group">
                    {!! Form::label('parent page', 'Parent page') !!}
                    {{ Form::text('page_id', $pageComment->page_id, ['class'=>'form-control', 'placeholder'=> 'Parent page' ]) }}
                </div>

                <div class="form-group">
                    {!! Form::label('parent comment', 'Parent comment') !!}
                    {{ Form::text('parent_id', $pageComment->parent_id, ['class'=>'form-control', 'placeholder'=> 'Parent comment' ]) }}
                </div>

                {{ Form::submit('Save', ['class' => 'btn btn-info']) }}
                {{ Form::close() }}

            </div>
        </article>
    </div>
@endsection