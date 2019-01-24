<ul>
@forelse ($lastComments as $lastComment)

	<li>{{ $lastComment->id }}{{ $lastComment->content }}</li>

@empty

@endforelse
</ul>