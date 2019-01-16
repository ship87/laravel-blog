@extends('layouts.app')

@section('content')
<div class="container">
	<div class="col-md-8 col-md-offset-2">

		{{ $post->created_user_id }}
		{{ $post->created_at }}

		{{ $post->title }}

		{{ $post->slug }}
		{{ $post->content }}

	</div>
	<div class="col-md-8 col-md-offset-2">

	</div>
</div>
@endsection