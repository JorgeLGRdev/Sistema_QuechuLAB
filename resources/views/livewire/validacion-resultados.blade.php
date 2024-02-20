<div>
    @if ($estudios)
    <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        <h2 class="text-2xl font-semibold text-blue-600 text-center">Validación de resultados</h2>
        <div class="overflow-y-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Clave
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Estudio
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Resultado
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Unidades
                        </th>
                        <th scope="col" colspan="3" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Valores de referencia
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($estudios as $indice => $estudio)
                        @if ($estudio->reporte_especial === 'S')
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                {{$estudio->id}}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                {{$estudio->nombre}}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap"></td>
                            <td class="px-6 py-4 whitespace-nowrap"></td>
                            <td class="px-6 py-4 whitespace-nowrap"></td>
                        </tr>
                            @php
                                $resultadosAux = \App\Helpers\Helpers::obtenerResultados($estudio->id, $orden->id);               
                            @endphp   
                            @if (!$resultadosAux->isEmpty())
                            @foreach ($resultadosAux as $resultado)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap"></td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{$resultado->parametro}}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if ($resultado->val_ref_texto != '' || $resultado->val_ref_inicial != '' || $resultado->val_ref_final != '')
                                            <input type="text" value="{{$resultado->resultado}}" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" readonly>
                                        @endif
                                    <td class="px-6 py-4 whitespace-nowrap">{{$resultado->unidades}}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <table>
                                            <tbody>
                                                <tr>
                                                    <td class="px-6 py-4 whitespace-nowrap">{{$resultado->val_ref_texto}}</td>
                                                    <td class="px-6 py-4 whitespace-nowrap">{{$resultado->val_ref_inicial}}</td>
                                                    <td class="px-6 py-4 whitespace-nowrap">{{$resultado->val_ref_final}}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            @endforeach   
                            @endif
                        @else
                            @if ($estudio->es_perfil === 's')
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{$estudio->id}}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{$estudio->nombre}}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap"></td>
                                <td class="px-6 py-4 whitespace-nowrap"></td>
                                <td class="px-6 py-4 whitespace-nowrap"></td>
                            </tr>
                            @else
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{$estudio->id}}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{$estudio->nombre}}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <input type="text" wire:model="resultados.{{ $estudio->id }}"  class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" readonly>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{$estudio->unidades}}
                                </td>
                                
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <tbody  class="bg-white divide-y divide-gray-200">
                                            @php
                                            $valoresReferenciaDelEstudio = $valores_referencia[$indice];
                                            @endphp
                                            @foreach ($valoresReferenciaDelEstudio as $valorReferencia)
                                              <!-- Aquí puedes trabajar con cada valor de referencia del estudio actual -->
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $valorReferencia->valor_texto}}</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $valorReferencia->valor_inicial}}</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $valorReferencia->valor_final}}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            @endif                         
                        @endif
                    
                    @endforeach 
                </tbody>
            </table>

            <div class="flex justify-center mt-4">
                <button wire:click="guardarValidacion" class="px-4 py-2 bg-teal-600 text-white rounded hover:bg-teal-700">Validar Resultados</button>
                <button wire:click="resetData" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">Cancelar</button>
            </div>          
            <div wire:loading>Cargando...</div>    
        </div>
    </div>
    @endif
</div>
