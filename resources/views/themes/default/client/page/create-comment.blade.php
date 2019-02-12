<div class="form-body">
    {{ Form::open(['method' => 'POST','route' => [config('app.theme').'admin.page-comments.store'],'style'=>'form-horizontal']) }}
    {{ csrf_field() }}

    <div class="form-group">
        {!! Form::label('name', u__('client.your name')) !!}
        {{ Form::text('name', old('name'), ['class'=>'form-control', 'placeholder'=>u__('client.name') ]) }}
        {{ $errors->first('title') }}
    </div>

    <div class="form-group">
        {!! Form::label('content', u__('client.comment')) !!}
        {{ Form::textarea('content', old('content'), ['class'=>'form-control', 'placeholder'=> u__('client.content') ]) }}
        {{ $errors->first('content') }}
    </div>

    @if(config('app.comment_google_recaptcha') and env('GOOGLE_RECAPTCHA_KEY'))
        <div class="g-recaptcha" data-sitekey="{{env('GOOGLE_RECAPTCHA_KEY')}}"></div>
        {{ $errors->first('g-recaptcha-response') }}
    @endif

    {{ Form::hidden('page_id', $pageId) }}

    {{ Form::submit('Add', ['class' => 'btn btn-info']) }}
    {{ Form::close() }}

</div>