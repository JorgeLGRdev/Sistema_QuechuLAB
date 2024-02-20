<div>
    {{-- Success is as dangerous as failure. --}}
    @if (auth()->user()->hasRole('Quimico'))
    @if ($estudio)
    <div class="bg-white shadow overflow-x-auto sm:rounded-lg p-6">
        <h2 class="text-2xl font-bold text-gray-900 mb-4">Valores de referencia</h2>

        <table class="w-full text-sm text-left text-gray-500">
            <thead class="text-xs text-gray-900 uppercase bg-teal-500">
                <tr class="hover:bg-teal-700 text-white">
                    <th scope="col" class="px-6 py-3">Sexo</th>
                    <th scope="col" class="px-6 py-3">Edad inicial</th>
                    <th scope="col" class="px-6 py-3">Periodo inicial</th>
                    <th scope="col" class="px-6 py-3">Edad final</th>
                    <th scope="col" class="px-6 py-3">Periodo final</th>
                    <th scope="col" class="px-6 py-3">Valor en texto</th>
                    <th scope="col" class="px-6 py-3">Valor inicial</th>
                    <th scope="col" class="px-6 py-3">Valor final</th>
                    <th scope="col" class="px-6 py-3">Nota predefinida</th>
                    <th scope="col" class="px-6 py-3">Altura inicial</th>
                    <th scope="col" class="px-6 py-3">Altura final</th>
    
                    @if (auth()->user()->hasRole('Quimico'))
                    <th scope="col" class="px-6 py-3">Acciones</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @if($valoresReferencia)
                    @foreach($valoresReferencia as $valorReferencia)
                        <tr class="bg-white hover:bg-teal-100 text-blue">
                            <td class="px-6 py-4">{{ ($valorReferencia->sexo == "F" ? 'Femenino': ($valorReferencia->sexo == "M" ? 'Masculino':'General')) }}</td>
                            <td class="px-6 py-4">{{ $valorReferencia->edad_inicial }}</td>
                            <td class="px-6 py-4">{{ ($valorReferencia->periodo_inicial == "D" ? 'Dias':($valorReferencia->periodo_inicial == "M" ? 'Meses':'Años')) }}</td>
                            <td class="px-6 py-4">{{ $valorReferencia->edad_final }}</td>
                            <td class="px-6 py-4">{{ ($valorReferencia->periodo_final == "D" ? 'Dias':($valorReferencia->periodo_final == "M" ? 'Meses':'Años')) }}</td>
                            <td class="px-6 py-4">{{ $valorReferencia->valor_texto }}</td>
                            <td class="px-6 py-4">{{ $valorReferencia->valor_inicial }}</td>
                            <td class="px-6 py-4">{{ $valorReferencia->valor_final }}</td>
                            <td class="px-6 py-4">{{ $valorReferencia->nota_predefinida }}</td>
                            <td class="px-6 py-4">{{ $valorReferencia->altura_inicial }}</td>
                            <td class="px-6 py-4">{{ $valorReferencia->altura_final }}</td>
    
                            <td class="px-6 py-4">
                                <button wire:click="editar({{ $valorReferencia->id }})" class="hover:text-blue-400">Editar</button>
                                <button wire:click="eliminar({{ $valorReferencia->id }})" class="hover:text-red-400">Eliminar</button>
                            </td>
    
                            
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
    @endif
    @endif
</div>
