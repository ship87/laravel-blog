@extends('themes.default.layouts.app')

@section('content')
    <div class="container">

        {{ csrf_field() }}

        {!! Form::open(['route' => 'contact.store']) !!}

        <div class="form-group">
            {!! Form::label('name', 'Your Name') !!}
            {!! Form::text('name', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('email', 'E-mail Address') !!}
            {!! Form::text('email', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('message', 'Message') !!}
            {!! Form::textarea('msg', null, ['class' => 'form-control']) !!}
        </div>

        @if(config('app.google_recaptcha') and env('GOOGLE_RECAPTCHA_KEY'))
            <div class="g-recaptcha"
                 data-sitekey="{{env('GOOGLE_RECAPTCHA_KEY')}}">
            </div>
        @endif

        {!! Form::submit('Submit', ['class' => 'btn btn-info']) !!}

        {!! Form::close() !!}

        {{ $errors->first('name') }}
        {{ $errors->first('email') }}
        {{ $errors->first('msg') }}

        @if(config('app.google_recaptcha') and env('GOOGLE_RECAPTCHA_KEY'))
        {{ $errors->first('g-recaptcha-response') }}
        @endif

        {{ session()->get( 'sendMessage' ) }}

    </div>
@endsection