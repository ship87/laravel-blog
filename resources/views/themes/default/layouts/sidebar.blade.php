<div class="sidebar__categories">
	@isset($categoriesWidget)
   		@include(config('app.theme').'client.widgets.categories')
	@endisset
</div>

<div class="sidebar__lastcomments">
	@isset($lastCommentsWidget)
    	@include(config('app.theme').'client.widgets.last-comments')
	@endisset
</div>