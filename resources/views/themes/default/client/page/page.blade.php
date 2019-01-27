@extends('themes.default.layouts.app')

@section('content')
<div class="container">
	<div class="content">

		{{ $pageData->created_user_id }}
		{{ $pageData->created_at }}

		{{ $pageData->title }}

		{{ $pageData->slug }}
		{{ $pageData->content }}

	</div>
	<div class="comments">
		@include(config('app.theme').'client.blog.comments', ['comments'=>$pageData->comments])
	</div>
</div>
@endsection