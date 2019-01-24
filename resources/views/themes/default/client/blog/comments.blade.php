@forelse ($comments as $comment)
    <div class="col-xs-12">
        {{ $comment->created_at }}
        {{ $comment->content }}
    </div>
@empty
@endforelse

@forelse ($lastComments as $lastComment)
<ul>
	<li>{{ $lastComment->id }}{{ $lastComment->content }}</li>
	@if(count($lastComment->childs) > 0)
	@include(config('app.theme').'client.widgets.last-comments-items',['items' => $lastComment->childs])
	@endif
</ul>
@empty
@endforelse