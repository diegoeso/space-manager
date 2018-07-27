@if (Session::has('info'))
<div class="alert alert-success alert-dismissible">
    <button aria-hidden="true" class="close" data-dismiss="alert" type="button">
        ×
    </button>
    <h4>
        <i class="icon fa fa-check">
        </i>
        Alert!
    </h4>
    {{ Session::get('info') }}
</div>
@endif
