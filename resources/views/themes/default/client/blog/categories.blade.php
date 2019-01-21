<div class="col-xs-12">
    @forelse ($categories as $category)
        {{ $category->slug }}
    @empty
    @endforelse
</div>