<div>
    {{-- A good traveler has no fixed plans and is not intent upon arriving. --}}
    @if ($estudio)
    <div class="bg-white shadow overflow-hidden sm:rounded-lg p-6">
        <h2 class="text-2xl font-bold text-gray-900 mb-2">Nombre: <span class="font-normal">{{ $estudio->nombre }}</span>
        </h2>
        <p>Precio: <span class="font-normal">{{ $estudio->precio }}</span></p>
        <p class="text-lg text-gray-700 mb-1">Contenedor: <span class="font-medium">{{ $estudio->contenedor }}</span></p>
        <p class="text-lg text-gray-700 mb-1">Método: <span class="font-medium">{{ $estudio->metodo }}</span></p>
        <p class="text-lg text-gray-700 mb-1">Abreviatura: <span class="font-medium">{{ $estudio->abreviatura }}</span></p>
        <p class="text-lg text-gray-700 mb-1">Unidades: <span class="font-medium">{{ $estudio->unidades }}</span></p>
        <p class="text-lg text-gray-700 mb-1">Tipo de muestra: <span class="font-medium">{{ $estudio->tipo_muestra }}</span></p>
        <p class="text-lg text-gray-700 mb-1">Sexo: <span class="font-medium">{{ ($estudio->sexo =='F'? 'Femenino' : ($estudio->sexo =='M' ? 'Masculino':'General') ) }}</span></p>
        <p class="text-lg text-gray-700 mb-1">Horas de proceso: <span class="font-medium">{{ $estudio->horas_proceso }}</span></p>
        <p class="text-lg text-gray-700 mb-1">Dias de entrega: <span class="font-medium">{{ $estudio->dias_entrega }}</span></p>
        <p class="text-lg text-gray-700 mb-1">Reporte especial: <span class="font-medium">{{ ($estudio->reporte_especial=='S'? 'Si':'No') }}</span></p>
        
        @if (auth()->user()->hasRole('Quimico'))
        <a href="{{ route('estudios.edit', $estudio->id) }}" class="text-blue-500 hover:underline">Editar</a>

        @endif
            <!-- Verificar permiso -->
        @if (auth()->user()->can('eliminar paciente'))
            <!-- Mostrar boton para eliminar -->
            <form action="{{ route('estudios.destroy', $estudio->id) }}" method="POST" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-red-500 hover:underline ml-2">Eliminar</button>
            </form>
        @endif
    </div>
    @endif
</div>
