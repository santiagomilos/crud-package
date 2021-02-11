@extends("layouts.app")

@section("content")
    <div class="container-fluid">

        {{-- ENCABEZAOD --}}
        <div class="pb-2">
            @if(!empty($[model]->id))
                <x-title-header title="Actualizar [model]"
                                :urls="[['[template]', route('[template]-list')],['[model] #'. $[model]->id]]">
                </x-title-header>
            @else
                <x-title-header title="Crear [model]"
                                :urls="[['[template]', route('[template]-list')],['Crear [model]']]">
                </x-title-header>
            @endif
        </div>

        <div class="card">
            <div class="card-body">
                @include("[template].includes._form")
            </div>
        </div>

    </div>
@endsection
