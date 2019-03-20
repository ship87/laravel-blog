<div class="row">

    <h2>{{ u__($dataName) }}</h2>

    @foreach ($dataHeader as $nameColumn=>$sizeColumn)
        <div class="col-xs-{{ $sizeColumn }}">
            <b>{{ $nameColumn }}</b>
        </div>
    @endforeach
</div>