@extends(config('app.theme').'client.index')

@section('content')
    <div class="col-md-9 col-xs-12">

        <div class="post">
            <div class="col-xs-12">
                <h1>{{ $pageData->title }}</h1>
            </div>
            <div class="col-xs-3">
                {{ $pageData->created_at->format('d F Y') }}
            </div>
            <div class="col-xs-2">
                {{ $pageData->createdUser->name }}
            </div>
            <div class="col-xs-4 categories">
                @include(config('app.theme').'client.blog.categories', ['categories'=>$pageData->categories])
            </div>
            <div class="col-xs-12 post_content">
                {!! $pageData->content !!}
            </div>
            <div class="col-xs-12 tags">
                @include(config('app.theme').'client.blog.tags', ['tags'=>$pageData->tags])
            </div>
        </div>

        <div class="col-xs-12 add-comment">
            <div class="col-xs-12">
                <h3>{{ u__('client.your comment') }}</h3>
            </div>
            <div class="col-xs-12">
                @include(config('app.theme').'client.blog.create-comment', ['postId'=>$pageData->id])
            </div>
        </div>

        <div class="col-xs-12 comments">
            @include(config('app.theme').'client.blog.comments', ['comments'=>$pageData->comments])
        </div>

    </div>
@endsection

@section('sidebar')
    <div class="col-md-3 col-xs-12">
        @include(config('app.theme').'layouts.sidebar')
    </div>
@endsection

