@forelse ($comments as $comment)
<div class="col-xs-12">
	{{ $comment->created_at }}
	{{ $comment->content }}
</div>
@empty
@endforelse