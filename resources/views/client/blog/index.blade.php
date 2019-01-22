@extends('layouts.app')

@section('content')
<div class="container">
	<div class="col-md-8 col-md-offset-2">
		@foreach ($posts as $post)

		{{ $post->created_user_id }}
		{{ $post->created_at }}

		<a href="{{ $post->url }}">{{ $post->title }}</a>

		{{ $post->content }}
		@endforeach
	</div>
	<div class="col-md-8 col-md-offset-2">
		{{ $posts->links() }}
	</div>
</div>
@endsection