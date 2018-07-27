<div class="box-header with-border">
    <h3 class="box-title">
        {{ $modulo }}
    </h3>
    <div class="box-tools">
        @if ($ruta)
        <a class="btn btn-primary btn-sm" href="{{ route($ruta)}}">
            <span class="fa fa-plus">
            </span>
            Nuevo
        </a>
        @endif
    </div>
</div>