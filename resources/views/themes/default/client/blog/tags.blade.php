<div class="col-xs-12">
    @forelse ($tags as $tag)
        {{ $tag->slug }}
    @empty
    @endforelse
</div>