@extends('layouts.app')

@section('content')
<div class="container">

	<div class="col-md-8 col-md-offset-2">
		@include('client.blog.categories', ['categories'=>$pageData->categories])
	</div>

	<div class="col-md-8 col-md-offset-2">

		{{ $pageData->created_user_id }}
		{{ $pageData->created_at }}

		{{ $pageData->title }}

		{{ $pageData->slug }}
		{{ $pageData->content }}
	</div>

	<div class="col-md-8 col-md-offset-2">
		@include('client.blog.tags', ['tags'=>$pageData->tags])
	</div>

</div>
@endsection