@extends(config('app.theme').'admin.index')

@section('admin-content')
    <div class="row">
        <article>
            <div class="form-body">
				{{ Form::open(['method' => 'POST','route' => [config('app.theme').'admin.posts.store'],'style'=>'form-horizontal']) }}
                {{ csrf_field() }}

                @include(config('app.theme').'admin.previous-page')

                <div class="form-group">
                    {!! Form::label('title', u__('admin.title')) !!}
                    {{ Form::text('title', old('title'), ['class'=>'form-control', 'placeholder'=>u__('admin.title') ]) }}
					{{ $errors->first('title') }}
                </div>

                <div class="form-group">
                    {!! Form::label('slug', u__('admin.slug')) !!}
                    {{ Form::text('slug', old('slug'), ['class'=>'form-control', 'placeholder'=> u__('admin.slug') ]) }}
					{{ $errors->first('slug') }}
                </div>

                <div class="form-group">
                    {!! Form::label('content', u__('admin.content')) !!}
                    {{ Form::textarea('content', old('content'), ['class'=>'form-control', 'placeholder'=> u__('admin.content'),'id'=>'editor' ]) }}
					{{ $errors->first('content') }}
                </div>

                <div class="form-group">
                    {!! Form::label('no_comments', u__('admin.no comments')) !!}
                    {{ Form::select('no_comments', ['Y' => 'Yes', 'N' => 'No'], is_null(old('no_comments'))?'N':old('no_comments')) }}
                </div>


				<div class="form-group">
					{{ Form::label('categories[]', u__('admin.categories')) }}
					{{ Form::select('categories[]', $categories, old('categories[]'), ['class'=>'form-control', 'multiple']) }}
				</div>

				<div class="form-group">
					{{ Form::label('tags[]', u__('admin.tags')) }}
					{{ Form::select('tags[]', $tags, old('tags[]'), ['class'=>'form-control', 'multiple']) }}
				</div>

				<h3>{{ s__('admin.seo') }}</h3>

				<div class="form-group">
					{!! Form::label('title', u__('admin.title')) !!}
					{{ Form::text('seotitle', old('seotitle'), ['class'=>'form-control', 'placeholder'=> u__('admin.title') ]) }}
				</div>

				<div class="form-group">
					{!! Form::label('description', u__('admin.description')) !!}
					{{ Form::text('seodescription', old('seodescription'), ['class'=>'form-control', 'placeholder'=> u__('admin.description') ]) }}
				</div>

				<div class="form-group">
					{!! Form::label('keywords', u__('admin.keywords')) !!}
					{{ Form::text('seokeywords', old('seokeywords'), ['class'=>'form-control', 'placeholder'=> u__('admin.keywords') ]) }}
				</div>

                {{ Form::submit(u__('admin.save'), ['class' => 'btn btn-info']) }}
                {{ Form::close() }}

            </div>
        </article>
    </div>
@endsection