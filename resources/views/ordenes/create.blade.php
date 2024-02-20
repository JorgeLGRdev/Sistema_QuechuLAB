@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-4">
        <div class="bg-white shadow overflow-hidden sm:rounded-lg p-6">
            <h1 class="text-2xl font-semibold mb-4">Crear nueva orden de análisis</h1>
            @livewire('ordenes')
        </div>
    </div>
    
@endsection
