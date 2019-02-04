@extends(config('app.theme').'admin.index')

@section('admin-content')
    <div class="row">
        <article>
            <div class="form-body">
				{{ Form::open(['method' => 'POST','route' => [config('app.theme').'admin.categories.store'],'style'=>'form-horizontal']) }}
                {{ csrf_field() }}

                <div class="form-group">
                    {!! Form::label('title', u__('admin.title')) !!}
                    {{ Form::text('title', null, ['class'=>'form-control', 'placeholder'=>'Title' ]) }}
                </div>

                <div class="form-group">
                    {!! Form::label('slug', u__('admin.slug')) !!}
                    {{ Form::text('slug', null, ['class'=>'form-control', 'placeholder'=> 'Slug' ]) }}
                </div>

                <div class="form-group">
                    {!! Form::label('parent', u__('admin.parent')) !!}
                    {{ Form::text('parent_id', null, ['class'=>'form-control', 'placeholder'=> 'Parent' ]) }}
                </div>

                {{ Form::submit('Save', ['class' => 'btn btn-info']) }}
                {{ Form::close() }}

            </div>
        </article>
    </div>
@endsection