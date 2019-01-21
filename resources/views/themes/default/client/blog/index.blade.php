@extends(config('app.theme').'layouts.app')

@section('content')
<div class="container">
	<div class="col-xs-12">
		@foreach ($posts as $post)

		{{ $post->created_user_id }}
		{{ $post->created_at }}

		<a href="{{ $post->url }}">{{ $post->title }}</a>

		{{ $post->content }}
		@endforeach
	</div>
	<div class="col-xs-12">
		{{ $posts->links() }}
	</div>
</div>
@endsection