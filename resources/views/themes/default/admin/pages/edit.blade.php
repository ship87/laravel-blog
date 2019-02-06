@extends(config('app.theme').'admin.index')

@section('admin-content')
    <div class="row">
        <article>
            <div class="form-body">
				{{ Form::open(['method' => 'PUT','route' => [config('app.theme').'admin.pages.update', $page->id],'style'=>'form-horizontal']) }}
                {{ csrf_field() }}

                <div class="form-group">
                    {!! Form::label('title', u__('admin.title')) !!}
                    {{ Form::text('title', $page->title, ['class'=>'form-control', 'placeholder'=>u__('admin.title') ]) }}
                </div>

                <div class="form-group">
                    {!! Form::label('slug', u__('admin.slug')) !!}
                    {{ Form::text('slug', $page->slug, ['class'=>'form-control', 'placeholder'=> u__('admin.slug') ]) }}
                </div>

                <div class="form-group">
                    {!! Form::label('content', u__('admin.content')) !!}
                    {{ Form::textarea('content', $page->content, ['class'=>'form-control', 'placeholder'=> u__('admin.content'),'id'=>'editor' ]) }}
                </div>

                <div class="form-group">
                    {!! Form::label('no_comments', u__('admin.no comments')) !!}
                    {{ Form::select('no_comments', ['Y' => 'Yes', 'N' => 'No'], $page->no_comments) }}
                </div>

                <div class="form-group">
                    {!! Form::label('parent', u__('admin.parent')) !!}
                    {{ Form::text('parent_id', $page->parent_id, ['class'=>'form-control', 'placeholder'=> u__('admin.parent') ]) }}
                </div>

				<h3>{{ s__('admin.seo') }}</h3>

				<div class="form-group">
					{!! Form::label('title', u__('admin.title')) !!}
					{{ Form::text('seotitle', $page->seotitle->content??'', ['class'=>'form-control', 'placeholder'=> u__('admin.title') ]) }}
				</div>

				<div class="form-group">
					{!! Form::label('description', u__('admin.description')) !!}
					{{ Form::text('seodescription', $page->seodescription->content??'', ['class'=>'form-control', 'placeholder'=> u__('admin.description') ]) }}
				</div>

				<div class="form-group">
					{!! Form::label('keywords', u__('admin.keywords')) !!}
					{{ Form::text('seokeywords', $page->seokeywords->content??'', ['class'=>'form-control', 'placeholder'=> u__('admin.keywords') ]) }}
				</div>

                <h3>{{ s__('admin.categories') }}</h3>

                <div class="form-group">
                    {!! Form::label('keywords', u__('admin.keywords')) !!}
                    {{ Form::text('seokeywords', $page->seokeywords->content??'', ['class'=>'form-control', 'placeholder'=> u__('admin.keywords') ]) }}
                </div>

                {{ Form::submit('Save', ['class' => 'btn btn-info']) }}
                {{ Form::close() }}

            </div>
        </article>
    </div>
@endsection