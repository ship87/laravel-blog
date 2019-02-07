@forelse ($categoriesWidget as $category)
<ul>
    <li>{{ $category->slug }}</li>
	@if(count($category->childs) > 0)
		@include(config('app.theme').'client.widgets.categories-items',['items' => $category->childs])
	@endif
</ul>
@empty
@endforelse