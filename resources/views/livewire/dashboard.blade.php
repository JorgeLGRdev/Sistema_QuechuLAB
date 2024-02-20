<div>
    {{-- Knowing others is intelligence; knowing yourself is true wisdom. --}}
    <div>
        Fecha: {{ $date }}
        Hora: <span wire:poll.1000ms="refreshTime">{{ $time }}</span>    
    </div>
        <h3 class="text-lg leading-6 font-medium text-gray-900">
            Lista ordenes de análisis creadas este dia
        </h3>
        <table class="w-full text-sm text-left text-gray-500">
            <thead class="text-xs text-gray-900 uppercase bg-teal-500">
                <tr class="hover:bg-teal-700 text-white">
                    <th scope="col" class="px-6 py-3">Clave</th>
                    <th scope="col" class="px-6 py-3">Paciente</th>
                    <th scope="col" class="px-6 py-3">Estado</th>
                    <th scope="col" class="px-6 py-3">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @if ($ordenesDelDia)
                    @foreach ($ordenesDelDia as $orden)
                    <tr class="bg-white hover:bg-teal-100 text-blue">
                        <td class="px-6 py-4">
                            {{$orden->id}}
                        </td>
                        <td class="px-6 py-4">
                            {{ \App\Helpers\Helpers::nombrePaciente($orden->paciente_id) }}
                        </td>
                        <td class="px-6 py-4">
                            {{$orden->estado === 'espera' ? 'EN ESPERA':''}}
                            {{$orden->estado === 'resultados' ? 'RESULTADOS CAPTURADOS':''}}
                            {{$orden->estado === 'validados' ? 'RESULTADOS VALIDADOS':''}}
                        </td>
                        <td class="px-6 py-4">
                            <ul>
                                <li class="text-blue-500 hover:text-blue-700">
                                    <a href="{{ route('generate-labels', $orden->id) }}">Generar Etiquetas</a>
                                </li>
                                @if (auth()->user()->hasRole('Quimico'))
                                    @if ($orden->estado === 'validados')
                                    <li class="text-blue-500 hover:text-blue-700">
                                        <a href="{{ route('generate-informe', $orden->id) }}">Generar Informe de Resultados</a>
                                    </li>
                                    @endif
                                @endif
                            </ul>
                        </td>
                    </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
      
</div>
