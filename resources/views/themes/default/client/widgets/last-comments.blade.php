@forelse ($lastCommentsWidget as $lastComment)
	<div class="comment_widget">
		<div class="row">
			<div class="col-xs-5">
			{{ $lastComment->created_user }}
			</div>
			<div class="col-xs-7">
				{{ $lastComment->created_at }}
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12">
				<a href="{{ $lastComment->url }}">{!! mb_substr($lastComment->content,0,100).' ...' !!}</a>
			</div>
		</div>
	</div>
@empty
@endforelse