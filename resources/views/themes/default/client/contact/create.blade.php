@extends(config('app.theme').'client.index')

@section('content')
    <div class="container">
        {!! Form::open(['route' => 'contact.store']) !!}
        {{ csrf_field() }}

        <div class="form-group">
            {!! Form::label('name', u__('client.your name')) !!}
            {!! Form::text('name', null, ['class' => 'form-control']) !!}
            {{ $errors->first('name') }}
        </div>

        <div class="form-group">
            {!! Form::label('email', u__('client.e-mail address')) !!}
            {!! Form::text('email', null, ['class' => 'form-control']) !!}
            {{ $errors->first('email') }}
        </div>

        <div class="form-group">
            {!! Form::label('message', u__('client.message')) !!}
            {!! Form::textarea('msg', null, ['class' => 'form-control']) !!}
            {{ $errors->first('msg') }}
        </div>

        @if(config('app.contact_google_recaptcha') and env('GOOGLE_RECAPTCHA_KEY'))
            <div class="g-recaptcha" data-sitekey="{{env('GOOGLE_RECAPTCHA_KEY')}}">
            </div>
            {{ $errors->first('g-recaptcha-response') }}
        @endif

        {!! Form::submit(u__('client.submit'), ['class' => 'btn btn-info']) !!}
        {!! Form::close() !!}

        {{ session()->get( 'sendMessage' ) }}

    </div>
@endsection