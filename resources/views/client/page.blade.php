@extends('layouts.app')

@section('content')
<div class="container">
	<div class="col-md-8 col-md-offset-2">

		{{ $page->created_user_id }}
		{{ $page->created_at }}

		{{ $page->title }}

		{{ $page->slug }}
		{{ $page->content }}

	</div>
	<div class="col-md-8 col-md-offset-2">

	</div>
</div>
@endsection