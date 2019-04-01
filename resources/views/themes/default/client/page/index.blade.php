@extends(config('app.theme').'client.index')

@section('content')
    <div class="col-md-9 col-xs-12">

        <div class="page">
            <div class="col-xs-12">
                <h1>{{ $pageData->title }}</h1>
            </div>
            <div class="col-xs-12 page_content">
                {!! $pageData->content !!}
            </div>
        </div>

        <div class="col-xs-12 add-comment">
            <div class="col-xs-12">
                <h3>{{ u__('Your comment') }}</h3>
            </div>
            <div class="col-xs-12">
                @include(config('app.theme').'client.page.create-comment', ['pageId'=>$pageData->id])
            </div>
        </div>

        <div class="col-xs-12 comments">
            @include(config('app.theme').'client.page.comments', ['comments'=>$pageData->comments])
        </div>

    </div>
@endsection

@section('sidebar')
    <div class="col-md-3 col-xs-12">
        @include(config('app.theme').'layouts.sidebar')
    </div>
@endsection