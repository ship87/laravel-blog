@extends(config('app.theme').'client.index')

@section('content')
    <div class="container">
        {!! Form::open(['route' => 'contact.store']) !!}
        {{ csrf_field() }}

        <div class="form-group {{ $errors->first('name') ? 'has-error' : '' }}">
            {!! Form::label('name', u__('client.your name')) !!}
            {!! Form::text('name', null, ['class' => 'form-control']) !!}
            <span class="help-block">{{ $errors->first('name') }}</span>
        </div>

        <div class="form-group {{ $errors->first('email') ? 'has-error' : '' }}">
            {!! Form::label('email', u__('client.e-mail address')) !!}
            {!! Form::text('email', null, ['class' => 'form-control']) !!}
            <span class="help-block">{{ $errors->first('email') }}</span>
        </div>

        <div class="form-group {{ $errors->first('msg') ? 'has-error' : '' }}">
            {!! Form::label('message', u__('client.message')) !!}
            {!! Form::textarea('msg', null, ['class' => 'form-control']) !!}
            <span class="help-block">{{ $errors->first('msg') }}</span>
        </div>

        @if(config('app.contact_google_recaptcha') and env('GOOGLE_RECAPTCHA_KEY'))
			<div class="form-group {{ $errors->first('g-recaptcha-response') ? 'has-error' : '' }}">
				<div class="g-recaptcha" data-sitekey="{{env('GOOGLE_RECAPTCHA_KEY')}}">
				</div>
				<span class="help-block">{{ $errors->first('g-recaptcha-response') }}</span>
			</div>
        @endif

        {!! Form::submit(u__('client.submit'), ['class' => 'btn btn-info']) !!}
        {!! Form::close() !!}

        {{ session()->get( 'sendMessage' ) }}

    </div>
@endsection