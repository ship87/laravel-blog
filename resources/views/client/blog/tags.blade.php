@forelse ($tags as $tag)
{{ $tag->slug }}
@empty
@endforelse