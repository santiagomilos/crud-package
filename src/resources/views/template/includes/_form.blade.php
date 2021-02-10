@push("head")
    <link href="{{ asset("css/libs/select2.min.css") }}" rel="stylesheet">
@endpush

@push("endBody")
    <script src="{{ asset("js/libs/select2.min.js")}}"></script>
@endpush

<div class="row">
    <div class="col-md-4 col-sm-6">
        <form method="POST">
            @csrf

            <div class="form-group">
                <label for="example">Example <span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="example" required placeholder="example"
                       value="{{ !empty($[model]->example) ? $[model]->example : ""}}">
            </div>

            <button class="btn btn-primary">
                <i class="fa fa-save"></i>
                @if(!empty($[model]->id))
                    Actualizar [model]
                @else
                    Guardar [model]
                @endif
            </button>
        </form>
    </div>
</div>
