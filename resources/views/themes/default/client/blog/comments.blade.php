@forelse ($comments as $comment)
    <div class="row comment_post">
        <div class="col-xs-12">
            {{ $comment->created_at }}
        </div>
        <div class="col-xs-12">
            {{ $comment->createdUser->name }}
        </div>
        <div class="col-xs-12">
            {{ $comment->content }}
        </div>
    </div>
@empty
@endforelse