@extends("layouts.app")

@section("content")
    <div class="container-fluid">

        {{-- ENCABEZAOD --}}
        @if(!empty($[model]->id))
            <x-title-header title="Actualizar [model]"
                            :urls="[[[template], route('[template]-list')],[example #[model]->id]]">
            </x-title-header>
        @else
            <x-title-header title="Crear [model]"
                            :urls="[[[template], route('[template]-list')],['Crear [model]']]">
            </x-title-header>
        @endif

        <div class="card">
            <div class="card-body">
                @include("[template].includes._form")
            </div>
        </div>

    </div>
@endsection
