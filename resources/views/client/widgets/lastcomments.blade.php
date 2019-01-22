@forelse ($comments as $comment)
    {{ $comments->content }}
@empty
@endforelse