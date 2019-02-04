@extends(config('app.theme').'admin.index')

@section('admin-content')
    <div class="row">
        <article>
            <div class="form-body">
				{{ Form::open(['method' => 'POST','route' => [config('app.theme').'admin.categories.store'],'style'=>'form-horizontal']) }}
                {{ csrf_field() }}

                <div class="form-group">
                    {!! Form::label('title', 'Title') !!}
                    {{ Form::text('title', $category->title, ['class'=>'form-control', 'placeholder'=>'Title' ]) }}
                </div>

                <div class="form-group">
                    {!! Form::label('slug', 'Slug') !!}
                    {{ Form::text('slug', $category->slug, ['class'=>'form-control', 'placeholder'=> 'Slug' ]) }}
                </div>

                <div class="form-group">
                    {!! Form::label('parent', 'Parent') !!}
                    {{ Form::text('parent_id', $category->parent_id, ['class'=>'form-control', 'placeholder'=> 'Parent' ]) }}
                </div>

                {{ Form::submit('Save', ['class' => 'btn btn-info']) }}
                {{ Form::close() }}

            </div>
        </article>
    </div>
@endsection