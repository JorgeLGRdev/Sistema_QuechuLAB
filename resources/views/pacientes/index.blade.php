@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-4">
        <div class="bg-white shadow overflow-hidden sm:rounded-lg p-6">

 <!-- Modal create-->
 <div x-data="{ showModal: false }">
    <!-- Botón para abrir el modal -->
    <div class="grid grid-cols-2 gap-4">
        <div>
            <h1 class="text-2xl font-semibold mb-4">Gestión de Pacientes</h1>
        </div>
        <div>
            <button @click="showModal = true" class="bg-teal-500 hover:bg-teal-700 text-white font-bold py-2 px-4 rounded">Registrar Paciente</button>
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
                                <h2  class="text-lg font-semibold mb-4 text-center">Nuevo Paciente</h2>

                                <form method="POST" action="{{ route('pacientes.store') }}" class="p-6">
                                        @csrf
                                                    
                                        <div class="mb-4 flex justify-between">
                                            <label for="apellido_paterno" class="block text-gray-700 font-bold mr-2">Apellido Paterno</label>
                                            <input type="text" name="apellido_paterno" id="apellido_paterno" class="form-input rounded-md shadow-sm border-gray-300" required>
                                        </div>
                                        
                                        <div class="mb-4 flex justify-between">
                                            <label for="apellido_materno" class="block text-gray-700 font-bold mb-2">Apellido Materno</label>
                                            <input type="text" name="apellido_materno" id="apellido_materno" class="form-input rounded-md shadow-sm border-gray-300" required>
                                        </div>
                    
                                        <div class="mb-4 flex justify-between">
                                            <label for="nombre" class="block text-gray-700 font-bold mb-2">Nombre</label>
                                            <input type="text" name="nombre" id="nombre" class="form-input rounded-md shadow-sm border-gray-300" required>
                                        </div>
                    
                                        <div class="mb-4 flex justify-between">
                                            <label for="sexo" class="block text-gray-700 font-bold mb-2">Sexo</label>
                                            <select name="sexo" id="sexo" class="form-select rounded-md shadow-sm border-gray-300" required>
                                                <option value="M">Masculino</option>
                                                <option value="F">Femenino</option>
                                            </select>
                                        </div>
                                        
                                        <div class="mb-4 flex justify-between items-center">
                                            <label for="fecha_nacimiento" class="block text-gray-700 font-bold mb-2">Fecha de Nacimiento</label>
                                            <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" class="form-input rounded-md shadow-sm border-gray-300" required>
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


        <div class="container mx-auto p-4">
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-xs text-gray-900 uppercase bg-teal-500">
                    <tr class="hover:bg-teal-700 text-white">
                        <th scope="col" class="px-6 py-3">Clave</th>
                        <th scope="col" class="px-6 py-3">Apellido paterno</th>
                        <th scope="col" class="px-6 py-3">Apellido materno</th>
                        <th scope="col" class="px-6 py-3">Nombre</th>
                        <th scope="col" class="px-6 py-3">Sexo</th>
                        <th scope="col" class="px-6 py-3">Edad</th>
                        <th scope="col" class="px-6 py-3">Acciones</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($pacientes as $paciente)
                        <tr class="bg-white hover:bg-teal-100 text-blue">
                            <td class="px-6 py-4">{{ $paciente->id }}</td>
                            <td class="px-6 py-4">{{ $paciente->apellido_paterno }}</td>
                            <td class="px-6 py-4">{{ $paciente->apellido_materno }}</td>
                            <td class="px-6 py-4">{{ $paciente->nombre }}</td>
                            <td class="px-6 py-4">{{ ($paciente->sexo == 'M') ? 'Masculino':'Femenino' }}</td>
                            <td class="px-6 py-4">{{ \App\Helpers\Helpers::obtenerEdad($paciente->fecha_nacimiento) }} </td>
                            <td class="px-6 py-4">
                                <a href="{{ route('pacientes.edit', $paciente->id) }}" class="text-blue-500 hover:underline">Editar</a>
                                                              
                            <!-- Verificar permiso -->
                            @if (auth()->user()->can('eliminar paciente'))
                                <!-- Mostrar boton para eliminar -->

                            @endif

                                <form action="{{ route('pacientes.destroy', $paciente->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:underline ml-2">Eliminar</button>
                                </form>
                     
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        
    </div>
    
      
</div>

@endsection