@extends('themes.default.layouts.app')

@section('content')
<div class="row">
	<div class="col-xs-12">
		<div class="panel panel-default">
			<div class="panel-heading"><h1>Dashboard</h1>

				@if (session('status'))
					<div class="alert alert-success">
						{{ session('status') }}
					</div>
				@endif
			</div>

			<div class="panel-body">

				<div class="col-md-2 col-xs-12">
					@include(config('app.theme').'admin.menu')
				</div>
				<div class="col-md-10 col-xs-12">
					@yield('admin-content')
				</div>
			</div>
		</div>
	</div>
</div>

@endsection

@section('scripts')
	@include(config('app.theme').'layouts.scripts.admin')
@endsection
