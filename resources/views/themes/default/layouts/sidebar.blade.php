<div class="sidebar__categories">
	@isset($categories)
   		@include(config('app.theme').'client.widgets.categories')
	@endisset
</div>

<div class="sidebar__lastcomments">
	@isset($lastComments)
    	@include(config('app.theme').'client.widgets.last-comments')
	@endisset
</div>