@forelse ($items as $item)
<ul>
	<li>{{ $item->slug }}</li>
	@if(count($item->childs) > 0)
		@include(config('app.theme').'client.widgets.categories-items',['items' => $item->childs])
	@endif
</ul>
@empty
@endforelse