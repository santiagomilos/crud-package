@extends("layouts.app")

@push("head")
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
@endpush
@push("endBody")
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
    @includeJS(["url"=>"[template]/assets/_[template].js", "params" => [
    "[URL_DELETE]" => route("[template]-delete"),
    "[PATH_AJAX]" => route("[template]-list"),
    "[URL_FORM]" => route("[template]-form")
    ]])
@endpush

@section("content")

    <x-title-header title="Lista de [template]" :urls="[['[template]']]"></x-title-header>

    <div class="card border-right">
        <div class="card-body">

            <div class="row mb-3">
                <div class="col text-right">
                    <a href="{{ route("[template]-form") }}" class="btn btn-dark">
                        <i class="fa fa-save"></i>
                        Crear [model]
                    </a>
                </div>
            </div>

            <div class="row">
                <div class="col-12 table-responsive">
                    <table id="datatable"
                           class="table table-striped table-bordered dt-responsive display no-wrap" style="width:100%">
                        <thead>
                        <tr>
                            <th>id</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
