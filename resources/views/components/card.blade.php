
<div class="card">
    <div class="card-body table-responsive">
        <div class="d-flex align-items-start">
            <h4 class="card-title mb-0">{{ @$header }}</h4>
            @if (@$collapse)
                <div class="ml-auto">
                    <a data-toggle="collapse" href="#detailList" role="button" aria-expanded="false" aria-controls="detailList">
                        {{ $collapse }} <span class="iconDrop fas fa-angle-down"></span>
                    </a>
                </div>
            @endif
        </div>
        <br>
        
        {{ $slot }}
    </div>
</div>