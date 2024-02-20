<div>
    {{-- Do your work, then step back. --}}
    @if ($estudio)
        @if (!$parametros->isEmpty())
            <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                <h2 class="text-2xl font-semibold text-blue-600 text-center">Captura de resultados: {{$estudio->nombre}}</h2>
                <div class="overflow-y-auto">
                    <table  class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">PARÁMETRO</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">RESULTADO</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">UNIDADES</th>
                                <th colspan="3" scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">VALORES DE REFERENCIA</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($parametros as $parametro)
                                <tr>
                                    @if ($parametro->val_ref_texto != '' || $parametro->val_ref_inicial != '' || $parametro->val_ref_final != '')
                                        <td class="px-6 py-4 whitespace-nowrap">{{$parametro->parametro}}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <input type="text" wire:model="resultados.{{$parametro->id}}" placeholder="Ingrese resultado" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" required>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{$parametro->unidades}}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{$parametro->val_ref_texto}}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{$parametro->val_ref_inicial}}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{$parametro->val_ref_final}}</td>
                                    @else
                                        <td class="px-6 py-4 whitespace-nowrap">{{$parametro->parametro}}</td>
                                        <td class="px-6 py-4 whitespace-nowrap"></td>
                                        <td class="px-6 py-4 whitespace-nowrap"></td>
                                        <td class="px-6 py-4 whitespace-nowrap"></td>
                                        <td class="px-6 py-4 whitespace-nowrap"></td>
                                        <td class="px-6 py-4 whitespace-nowrap"></td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="flex justify-center mt-4">
                        <button wire:click="guardarResultados" class="px-4 py-2 bg-teal-600 text-white rounded hover:bg-teal-700">Guardar Resultados</button>
                        <button wire:click="resetData" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">Cancelar</button>

                        <div wire:loading>Cargando...</div>
                    </div>
                </div>
            </div>
        @endif
    @endif
</div>
