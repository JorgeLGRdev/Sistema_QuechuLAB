@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-4">
        <div class="bg-white shadow overflow-hidden sm:rounded-lg p-6">
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <h1 class="text-2xl font-semibold mb-4">Gestión de ordenes de análisis</h1>
                </div>
                <div>
                    <a href="{{ route('ordenes.create') }}" class="inline-block bg-teal-500 hover:bg-teal-700 text-white font-bold py-2 px-4 rounded">Registrar Orden</a>
                </div>
            </div>
            @livewire('buscadorOrdenes')
            @livewire('detalleOrden')
            @livewire('resultadosForm')
            @livewire('reportesEspeciales')
            
            @livewire('validacionResultados')

        </div>
    </div>
</div>
@endsection
