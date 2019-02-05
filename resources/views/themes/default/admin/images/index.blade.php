@extends(config('app.theme').'admin.index')

@section('admin-content')
<div class="row">
	<div class="col-xs-12">
		<iframe src="{{ config('app.url_admin') }}/filemanager" style="width: 100%; height: 500px; overflow: hidden; border: none;"></iframe>
	</div>
</div>
@endsection