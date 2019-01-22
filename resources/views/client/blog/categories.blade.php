@forelse ($categories as $category)
{{ $category->slug }}
@empty
@endforelse