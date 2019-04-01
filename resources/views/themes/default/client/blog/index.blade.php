@extends(config('app.theme').'client.index')

@section('content')
    <div class="col-md-9 col-xs-12">

        @isset($search)
            @if ($search)
                <h3>{{ u__('client.search results for:').$search }}</h3>
            @endif
        @endisset

        @isset($posts)
            @foreach ($posts as $post)
                <div class="row post">
                    <div class="col-xs-12">
                        <h2><a href="{{ $post->url }}">{{ $post->title }}</a></h2>
                    </div>
                    <div class="col-xs-3">
                        {{ $post->created_at->format('d F Y') }}
                    </div>
                    <div class="col-xs-2">
                        {{ $post->createdUser->name }}
                    </div>
                    <div class="col-xs-4 categories">
                        @include(config('app.theme').'client.blog.categories', ['categories'=>$post->categories])
                    </div>
                    <div class="col-xs-12 post_content">
                        {!! mb_substr($post->content,0,100).' ...' !!}
                    </div>
                    <div class="col-xs-2">
                        <a href="{{ $post->url }}">read more...</a>
                    </div>
                </div>
            @endforeach
        @endisset
        <div class="row">
            {{ $posts->links() }}
        </div>
    </div>
@endsection

@section('sidebar')
    <div class="col-md-3 col-xs-12">
        @include(config('app.theme').'layouts.sidebar')
    </div>
@endsection



