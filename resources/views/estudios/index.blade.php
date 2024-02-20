@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-4">
        <div class="bg-white shadow overflow-hidden sm:rounded-lg p-6">

 <!-- Modal create-->
 <div x-data="{ showModal: false }">

    <div class="grid grid-cols-2 gap-4" >
        <div>
            <h1 class="text-2xl font-semibold mb-4">Gestión de estudios</h1>
        </div>
        <div>
            @if (auth()->user()->hasRole('Quimico'))
            <!-- Botón para abrir el modal -->
            <button @click="showModal = true" class="bg-teal-500 hover:bg-teal-700 text-white font-bold py-2 px-4 rounded">Registrar Estudio</button>
            @endif
        </div>
    </div>


                <!-- Modal -->
                <div  x-show="showModal" x-cloak class="fixed z-10 inset-0 overflow-y-auto">
                    <!-- Contenido del modal -->
                    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                        <!-- Fondo oscuro detrás del modal -->
                        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                        </div>

                        <!-- Contenedor del modal -->
                        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                        <!-- Contenido del modal en sí -->
                        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                            <!-- Aquí incluirías el formulario de registro de pacientes -->
                            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                                <h2  class="text-lg font-semibold mb-4 text-center">Nuevo Estudio</h2>

                                <form method="POST" action="{{ route('estudios.store') }}" class="p-6">
                                        @csrf
                                                    
                                 
                                        <div class="mb-4 flex justify-between">
                                            <label for="nombre" class="block text-gray-700 font-bold mb-2">Nombre</label>
                                            <input type="text" name="nombre" id="nombre" class="form-input rounded-md shadow-sm border-gray-300" required>
                                        </div>
                    
                                        
                                        <div class="mb-4 flex justify-between">
                                            <label for="precio" class="block text-gray-700 font-bold mb-2">Precio</label>
                                            <input type="number" name="precio" id="precio" class="form-input rounded-md shadow-sm border-gray-300" required>
                                        </div>

                                        <div class="mb-4 flex justify-between">
                                            <label for="contenedor" class="block text-gray-700 font-bold mb-2">Contenedor</label>
                                            <select name="contenedor" id="contenedor" class="form-select rounded-md shadow-sm border-gray-300" required>
                                                <option value="Tubo rojo">Tubo rojo</option>
                                                <option value="Tubo morado">Tubo morado</option>
                                                <option value="Tubo azul">Tubo azul</option>
                                                <option value="Frasco tapa roja">Frasco tapa roja</option>
                                                <option value="Medio de cultivo de transporte">Medio de cultivo de transporte</option>
                                                <option value="Recipiente de 2 litros">Recipiente de 2 litros</option>
                                            </select>
                                        </div>
                    
                                        <div class="mb-4 flex justify-between">
                                            <label for="metodo" class="block text-gray-700 font-bold mb-2">Método</label>
                                            <select name="metodo" id="metodo" class="form-select rounded-md shadow-sm border-gray-300" required>
                                                <option value="Densitometría de flujo">Densitometría de flujo</option>
                                                <option value="Aglutinación en placa">Aglutinación en placa</option>
                                                <option value="Sedimentación en tubo de Wintrobe">Sedimentación en tubo de Wintrobe</option>
                                                <option value="Automatizado">Automatizado</option>
                                                <option value="Tinción de Wright">Tinción de Wright</option>
                                                <option value="Inmunocromatografía">Inmunocromatografía</option>
                                                <option value="Tinción de Azul de Metileno">Tinción de Azul de Metileno</option>
                                                <option value="Inmunoensayo cromatográfico">Inmunoensayo cromatográfico</option>
                                                <option value="Espectrofotometría automatizada">Espectrofotometría automatizada</option>
                                                <option value="Tinción Yodo-Lugol">Tinción Yodo-Lugol</option>
                                                <option value="Medio de cultivo, difusión en Agar sensidisco">Medio de cultivo, difusión en Agar sensidisco</option>
                                                <option value="Tinción Sternheimer-Malbin">Tinción Sternheimer-Malbin</option>

                                            </select>
                                        </div>
                                        
                                        <div class="mb-4 flex justify-between">
                                            <label for="abreviatura" class="block text-gray-700 font-bold mb-2">Abreviatura</label>
                                            <input type="text" name="abreviatura" id="abreviatura" class="form-input rounded-md shadow-sm border-gray-300" required>
                                        </div>
                                        
                                        <div class="mb-4 flex justify-between">
                                            <label for="area_id" class="block text-gray-700 font-bold mb-2">Area</label>
                                            <select name="area_id" id="area_id" class="form-select rounded-md shadow-sm border-gray-300" required>
                                                <option value="1">Hematología</option>
                                                <option value="2">Inmunología</option>
                                                <option value="3">Química clínica</option>
                                                <option value="4">Hormonales</option>
                                                <option value="5">Parasitología</option>
                                                <option value="6">Microbiología</option>
                                                <option value="7">Uroanálisis</option>
                                            </select>
                                        </div>
                    
                                        <div class="mt-6">
                                            <button type="submit" class="bg-teal-500 hover:bg-teal-700 text-white font-bold py-2 px-4 rounded">Guardar</button>
                                            <button type="button" @click="showModal = false" class="text-gray-500 hover:text-gray-700 font-bold py-2 px-4 ml-4">Cancelar</button>
                                            
                                        </div>
                                    </form>
                                
                            </div>

                        </div>
                    </div>
                </div>
            <!-- Modal create-->
        </div>

      <!-- BuscadorEstudios-->
      @livewire('buscadorEstudios')

           <!-- CRUD valores de referencia-->
           @livewire('crud-valores-referencia')

    </div>
</div>

@endsection