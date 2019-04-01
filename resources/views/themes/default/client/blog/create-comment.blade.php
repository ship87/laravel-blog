<div class="row form-body">
    {{ Form::open(['method' => 'POST','route' => [config('app.theme').'admin.post-comments.store'],'style'=>'form-horizontal']) }}
    {{ csrf_field() }}

    <div class="row">
        <div class="col-xs-4 form-group {{ $errors->first('title') ? 'has-error' : '' }}">
            {!! Form::label('name', u__('client.your name')) !!}
            {{ Form::text('name', old('name'), ['class'=>'form-control', 'placeholder'=>u__('client.name') ]) }}
            <span class="help-block">{{ $errors->first('title') }}</span>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-6 form-group {{ $errors->first('content') ? 'has-error' : '' }}">
            {!! Form::label('content', u__('client.comment')) !!}
            {{ Form::textarea('content', old('content'), ['class'=>'form-control', 'placeholder'=> u__('client.content'), 'rows' => 5 ]) }}
            <span class="help-block">{{ $errors->first('content') }}</span>
        </div>
    </div>

    @if(config('app.comment_google_recaptcha') and env('GOOGLE_RECAPTCHA_KEY'))
		<div class="form-group {{ $errors->first('g-recaptcha-response') ? 'has-error' : '' }}">
			<div class="g-recaptcha" data-sitekey="{{env('GOOGLE_RECAPTCHA_KEY')}}">
			</div>
			<span class="help-block">{{ $errors->first('g-recaptcha-response') }}</span>
		</div>
    @endif

    {{ Form::hidden('post_id', $postId) }}

    {{ Form::submit('Add', ['class' => 'btn btn-info']) }}
    {{ Form::close() }}
</div>