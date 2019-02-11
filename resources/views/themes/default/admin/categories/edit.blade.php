@extends(config('app.theme').'admin.index')

@section('admin-content')
    <div class="row">
        <article>
            <div class="form-body">
                {{ Form::open(['method' => 'PUT','route' => [config('app.theme').'admin.categories.update', $category->id],'style'=>'form-horizontal']) }}
                {{ csrf_field() }}

                @include(config('app.theme').'admin.previous-page')

                <div class="form-group">
                    {!! Form::label('title', u__('admin.title')) !!}
                    {{ Form::text('title', $category->title, ['class'=>'form-control', 'placeholder'=>u__('admin.title') ]) }}
                </div>

                <div class="form-group">
                    {!! Form::label('slug', u__('admin.slug')) !!}
                    {{ Form::text('slug', $category->slug, ['class'=>'form-control', 'placeholder'=> u__('admin.slug') ]) }}
                </div>

                <div class="form-group">
                    {!! Form::label('parent', u__('admin.parent')) !!}
                    {{ Form::select('parent_id', $categories, $category->parent_id) }}
                </div>

                {{ Form::submit('Save', ['class' => 'btn btn-info']) }}
                {{ Form::close() }}

            </div>
        </article>
    </div>
@endsection