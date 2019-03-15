<div class="row">
    @foreach ($dataHeader as $nameColumn=>$sizeColumn)
        <div class="col-xs-{{ $sizeColumn }}">
            <b>{{ $nameColumn }}</b>
        </div>
    @endforeach
</div>