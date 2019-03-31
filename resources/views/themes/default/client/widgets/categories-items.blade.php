<div id="collapse-{{$parent}}" class="panel-collapse collapse">
    @forelse ($items as $item)

        @if(count($item->childs) > 0)
            <div class="panel-group categories-menu" id="accordion-{{$parent}}">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-2">
                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion-{{$parent}}"
                                   href="#collapse-{{ $item->slug }}">
                                </a>
                            </div>
                            <div class="col-xs-10">
                                <a href="{{ url(config('app.url_blog').'/category/'.$item->slug) }}">{{ $item->title }}</a>
                            </div>
                        </div>
                    </div>
                    @include(config('app.theme').'client.widgets.categories-items',['items' => $item->childs,'parent'=>$item->slug ])
                </div>
            </div>

        @else

            <div class="panel-body">
                <div class="row">
                    <div class="col-xs-2">
                    </div>
                    <div class="col-xs-10">
                        <a href="{{ url(config('app.url_blog').'/category/'.$item->slug) }}">{{ $item->title }}</a>
                    </div>
                </div>
            </div>

        @endif

    @empty
    @endforelse
</div>