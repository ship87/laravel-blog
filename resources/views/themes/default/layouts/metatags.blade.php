@forelse ($metatags as $metatag)
	@if ($metatag->name == 'title')
		<title>{{ $metatag->content }}</title>
	@else
		<meta name="{{ $metatag->name }}" content="{{ $metatag->content }}"/>
	@endif
@empty
@endforelse
