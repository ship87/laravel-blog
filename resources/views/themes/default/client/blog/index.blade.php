@extends(config('app.theme').'client.index')

@section('content')
<div class="container">
	<div class="col-xs-12">
		@isset($posts)
			@foreach ($posts as $post)

			{{ $post->created_user_id }}
			{{ $post->created_at }}

			<a href="{{ $post->url }}">{{ $post->title }}</a>

			{{ $post->content }}
			@endforeach
		@endisset
	</div>
	<div class="col-xs-12">
		@isset($posts->links)
			{{ $posts->links() }}
		@endisset
	</div>
</div>
@endsection