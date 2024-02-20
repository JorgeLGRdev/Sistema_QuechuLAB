@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-4">
        <div class="bg-white shadow overflow-hidden sm:rounded-lg p-6">
            <h1 class="text-2xl font-bold mb-4">Editar estudio</h1>
            <form method="POST" action="{{ route('estudios.update', $estudio->id) }}" class="space-y-4">
                @csrf
                @method('PUT')
            
                <div>
                    <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre</label>
                    <input type="text" name="nombre" id="nombre" class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" value="{{ $estudio->nombre }}" required>
                </div>
                          
                <div>
                    <label for="precio" class="block text-sm font-medium text-gray-700">Precio</label>
                    <input type="number" name="precio" id="precio" class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" value="{{ $estudio->precio }}" required>
                </div>
    
                <div>
                    <label for="contenedor" class="block text-sm font-medium text-gray-700">Contenedor</label>
                    <select name="contenedor" id="contenedor" class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                        <option value="Tubo rojo" {{ $estudio->contenedor === 'Tubo rojo' ? 'selected' : '' }}>Tubo rojo</option>
                        <option value="Tubo morado" {{ $estudio->contenedor === 'Tubo morado' ? 'selected' : '' }}>Tubo morado</option>
                        <option value="Tubo azul" {{ $estudio->contenedor === 'Tubo azul' ? 'selected' : '' }}>Tubo azul</option>
                        <option value="Frasco tapa roja" {{ $estudio->contenedor === 'Frasco tapa roja' ? 'selected' : '' }}>Frasco tapa roja</option>
                        <option value="Medio de cultivo de transporte" {{ $estudio->contenedor === 'Medio de cultivo de transporte' ? 'selected' : '' }}>Medio de cultivo de transporte</option>
                        <option value="Recipiente de 2 litros" {{ $estudio->contenedor === 'Recipiente de 2 litros' ? 'selected' : '' }}>Recipiente de 2 litros</option>
                    </select>
    
                </div>
    
                <div>
                    <label for="metodo" class="block text-sm font-medium text-gray-700">Método</label>
                    <input type="text" name="metodo" id="metodo" class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" value="{{ $estudio->metodo }}" required>
                </div>
    
                <div>
                    <label for="abreviatura" class="block text-sm font-medium text-gray-700">Abreviatura</label>
                    <input type="text" name="abreviatura" id="abreviatura" class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" value="{{ $estudio->abreviatura }}" required>
                </div>
    
                <div>
                    <label for="unidades" class="block text-sm font-medium text-gray-700">Unidades</label>
                    <input type="text" name="unidades" id="unidades" class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" value="{{ $estudio->unidades }}" required>
                </div>
    
                <div>
                    <label for="tipo_muestra" class="block text-sm font-medium text-gray-700">Tipo de muestra</label>
                    <select name="tipo_muestra" id="tipo_muestra" class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                        <option value="Sangre total" {{ $estudio->tipo_muestra === 'Sangre total' ? 'selected' : '' }}>Sangre total</option>
                        <option value="Suero" {{ $estudio->tipo_muestra === 'Suero' ? 'selected' : '' }}>Suero</option>
                        <option value="Plasma citratado" {{ $estudio->tipo_muestra === 'Plasma citratado' ? 'selected' : '' }}>Plasma citratado</option>
                        <option value="Orina" {{ $estudio->tipo_muestra === 'Orina' ? 'selected' : '' }}>Orina</option>
                        <option value="Muestra fecal" {{ $estudio->tipo_muestra === 'Muestra fecal' ? 'selected' : '' }}>Muestra fecal</option>
                        <option value="Esputo" {{ $estudio->tipo_muestra === 'Esputo' ? 'selected' : '' }}>Esputo</option>
                    </select>
                </div>
    
                <div>
                    <label for="sexo" class="block text-sm font-medium text-gray-700">Sexo</label>
                    <select name="sexo" id="sexo" class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                        <option value="M" {{ $estudio->sexo === 'M' ? 'selected' : '' }}>Masculino</option>
                        <option value="F" {{ $estudio->sexo === 'F' ? 'selected' : '' }}>Femenino</option>
                        <option value="G" {{ $estudio->sexo === 'G' ? 'selected' : '' }}>General</option>
                    </select>
                </div>
    
                <div>
                    <label for="horas_proceso" class="block text-sm font-medium text-gray-700">Horas de proceso</label>
                    <input type="number" name="horas_proceso" id="horas_proceso" class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" value="{{ $estudio->horas_proceso }}" required>
                </div>
    
                <div>
                    <label for="dias_entrega" class="block text-sm font-medium text-gray-700">Dias de entrega</label>
                    <input type="number" name="dias_entrega" id="dias_entrega" class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" value="{{ $estudio->dias_entrega }}" required>
                </div>
    
                <div>
                    <label for="reporte_especial" class="block text-sm font-medium text-gray-700">Reporte especial</label>
                    <select name="reporte_especial" id="reporte_especial" class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                        <option value="S" {{ $estudio->reporte_especial === 'S' ? 'selected' : '' }}>Si</option>
                        <option value="N" {{ $estudio->reporte_especial === 'N' ? 'selected' : '' }}>No</option>
                    </select>
                </div>
    
                <div class="flex justify-center">
                    <button type="submit" class="py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-teal-600 hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 w-auto">
                        Guardar Cambios
                    </button>
                </div>
                
            </form>
        </div>
    </div>
@endsection
