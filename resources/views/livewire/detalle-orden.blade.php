<div>
    {{-- If you look to others for fulfillment, you will never truly be fulfilled. --}}
    @if($ordenSeleccionada)
    <div class="grid grid-cols-2 gap-4">
        <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            <h2 class="font-bold text-xl mb-2">Detalle de la orden:</h2>
            <p class="mb-2"><span class="font-semibold">Clave:</span> {{ $ordenSeleccionada->id}} <span class="font-semibold">Total:</span> ${{ $ordenSeleccionada->total}}</p>
            <p class="mb-2"><span class="font-semibold">Paciente:</span> {{$paciente->nombre}} {{$paciente->apellido_paterno}} {{$paciente->apellido_materno}} 
                <span class="font-semibold">    Sexo:</span> {{($paciente->sexo === 'F' ? 'Femenino': 'Masculino')}}
                <span class="font-semibold">    Edad:</span> {{ \App\Helpers\Helpers::obtenerEdad($paciente->fecha_nacimiento)}}
            </p>

            <p class="mb-2"><span class="font-semibold">Estudios:</span> {{ \App\Helpers\Helpers::estudiosOrden($ordenSeleccionada->id)}}</p>
            <p class="mb-2"><span class="font-semibold">Doctor:</span> {{$ordenSeleccionada->doctor}} </p>
            <p class="mb-2"><span class="font-semibold">Fecha:</span> {{ \App\Helpers\Helpers::formatFecha($ordenSeleccionada->created_at)}}
                <span class="font-semibold">Hora:</span> {{ \App\Helpers\Helpers::formatHora($ordenSeleccionada->created_at)}}
            </p>
       

        </div>

        <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            <h2 class="font-bold text-xl mb-2">Acciones:</h2>
            <a href="{{ route('generate-labels', $ordenSeleccionada->id) }}" class="text-blue-500 hover:underline">Generar etiquetas</a>
        

            @if (auth()->user()->hasRole('Quimico'))
            @if (!$reportes_especiales->isEmpty())
            <ul>
                @foreach ($reportes_especiales as $item)
                    <li wire:click="capturarResultadosRE({{$item->id}})" class="text-blue-500 hover:underline">
                        Capturar resultados de {{$item->nombre}}
                    </li>
                @endforeach
            </ul>
            @endif
            <ul>
                <li wire:click="capturarResultados({{$ordenSeleccionada->id}})" class="text-blue-500 hover:underline">
                    {{($ordenSeleccionada->estado === 'espera' ? 'Capturar': 'Modificar')}} resultados
                </li>
           
                @if ($ordenSeleccionada->estado === 'resultados')
                <li wire:click="validarResultados({{$ordenSeleccionada->id}})" class="text-blue-500 hover:underline">Validar resultados</li>
                @endif

                @if ($ordenSeleccionada->estado === 'validados')
                <a href="{{ route('generate-informe', $ordenSeleccionada->id) }}" class="text-blue-500 hover:underline">Generar informe de resultados</a>
                @endif
            </ul>
            @endif     
                 
        </div>
    </div>

    @endif
</div>
