@extends(config('app.theme').'admin.index')

@section('admin-content')
    <div class="row">
        <article>
            <div class="form-body">
				{{ Form::open(['method' => 'PUT','route' => [config('app.theme').'admin.posts.update',$post->id],'style'=>'form-horizontal']) }}
                {{ csrf_field() }}

                @include(config('app.theme').'admin.previous-page')

                <div class="form-group">
                    {!! Form::label('title', u__('admin.title')) !!}
                    {{ Form::text('title', $post->title, ['class'=>'form-control', 'placeholder'=>u__('admin.title') ]) }}
                </div>

                <div class="form-group">
                    {!! Form::label('slug', u__('admin.slug')) !!}
                    {{ Form::text('slug', $post->slug, ['class'=>'form-control', 'placeholder'=> u__('admin.slug') ]) }}
                </div>

                <div class="form-group">
                    {!! Form::label('content', u__('admin.content')) !!}
                    {{ Form::textarea('content', $post->content, ['class'=>'form-control', 'placeholder'=> u__('admin.content'),'id'=>'editor' ]) }}
                </div>

                <div class="form-group">
                    {!! Form::label('no_comments', u__('admin.no comments')) !!}
                    {{ Form::select('no_comments', ['Y' => 'Yes', 'N' => 'No'], $post->no_comments) }}
                </div>

				<div class="form-group">
					{{ Form::label('categories[]', u__('admin.categories')) }}
					{{ Form::select('categories[]', $categories, $selectedCategories, ['class'=>'form-control', 'multiple']) }}
				</div>

				<div class="form-group">
					{{ Form::label('tags[]', u__('admin.tags')) }}
					{{ Form::select('tags[]', $tags, $selectedTags, ['class'=>'form-control', 'multiple']) }}
				</div>

                <h3>{{ s__('admin.seo') }}</h3>

                <div class="form-group">
                    {!! Form::label('title', u__('admin.title')) !!}
                    {{ Form::text('seotitle', $post->seotitle->content??'', ['class'=>'form-control', 'placeholder'=> u__('admin.title') ]) }}
                </div>

                <div class="form-group">
                    {!! Form::label('description', u__('admin.description')) !!}
                    {{ Form::text('seodescription', $post->seodescription->content??'', ['class'=>'form-control', 'placeholder'=> u__('admin.description') ]) }}
                </div>

                <div class="form-group">
                    {!! Form::label('keywords', u__('admin.keywords')) !!}
                    {{ Form::text('seokeywords', $post->seokeywords->content??'', ['class'=>'form-control', 'placeholder'=> u__('admin.keywords') ]) }}
                </div>

                {{ Form::submit('Save', ['class' => 'btn btn-info']) }}
                {{ Form::close() }}

            </div>
        </article>
    </div>
@endsection