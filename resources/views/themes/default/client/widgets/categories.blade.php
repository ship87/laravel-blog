<div class="panel-group categories-menu" id="accordion">

    @forelse ($categoriesWidget as $category)

        <div class="panel panel-default">

            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-2">
                        @if(count($category->childs) > 0)
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion"
                               href="#collapse-{{$category->slug}}">
                            </a>
                        @endif
                    </div>
                    <div class="col-xs-10">
                        <a href="{{ url(config('app.url_blog').'/category/'.$category->slug) }}">{{ $category->title }}</a>
                    </div>
                </div>
            </div>

            @if(count($category->childs) > 0)
                @include(config('app.theme').'client.widgets.categories-items',['items' => $category->childs,'parent'=>$category->slug])
            @endif

        </div>

    @empty
    @endforelse

</div>
