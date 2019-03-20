{{ Form::open(['method' => 'GET','route' => [config('app.theme').'client'.config('app.url_blog')],'style'=>'form-horizontal']) }}

<div class="form-group search">
    {{ Form::text('search', old('search'), ['class'=>'form-control', 'placeholder'=>u__('client.search on blog') ]) }}
</div>

{{ Form::submit(u__('client.find'), ['class' => 'btn btn-info']) }}
{{ Form::close() }}