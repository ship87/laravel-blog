<div class="form-group search">
    {{ Form::open(['method' => 'GET','route' => [config('app.theme').'client'.config('app.url_blog')],'style'=>'form-horizontal']) }}
    <div class="col-xs-9">
        {{ Form::text('search', old('search'), ['class'=>'form-control', 'placeholder'=>u__('client.search on blog') ]) }}
    </div>
    <div class="col-xs-2">
        {{ Form::submit(u__('client.find'), ['class' => 'btn btn-info']) }}
    </div>
    {{ Form::close() }}
</div>