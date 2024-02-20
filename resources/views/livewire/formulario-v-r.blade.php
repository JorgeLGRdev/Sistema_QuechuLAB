<div>
    {{-- Success is as dangerous as failure. --}}
    {{--$estudio->id--}}
    {{-- $valorReferencia['estudio_id'] --}}
    @if (auth()->user()->hasRole('Quimico'))
    @if ($estudio)
    <div class="bg-white shadow overflow-hidden sm:rounded-lg p-6">
        <form wire:submit.prevent="save" class="mb-4">
            <div class="mb-2">
                <label for="sexo" class="block text-sm font-medium text-gray-700">Sexo</label>
                <select name="sexo" id="sexo"  wire:model="valorReferencia.sexo" class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                    <option value="F">Femenino</option>
                    <option value="M">Masculino</option>
                    <option value="G" selected>General</option>
                </select>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="edad_inicial" class="block text-sm font-medium text-gray-700">Edad inicial</label>
                    <input id="edad_inicial" name="edad_inicial" type="number" wire:model="valorReferencia.edad_inicial" class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                </div>
                <div>
                    <label for="periodo_inicial" class="block text-sm font-medium text-gray-700">Periodo inicial</label>
                    <select name="periodo_inicial" id="periodo_inicial" wire:model="valorReferencia.periodo_inicial"  class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                        <option value="D">Dia(s)</option>
                        <option value="M">Mes(es)</option>
                        <option value="A">Año(s)</option>
                    </select>
                </div>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="edad_final" class="block text-sm font-medium text-gray-700">Edad final</label>
                    <input id="edad_final" name="edad_final" type="number" wire:model="valorReferencia.edad_final" class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                </div>
                <div>
                    <label for="periodo_final" class="block text-sm font-medium text-gray-700">Periodo final</label>
                    <select name="periodo_final" id="periodo_final" wire:model="valorReferencia.periodo_final"  class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                        <option value="D">Dia(s)</option>
                        <option value="M">Mes(es)</option>
                        <option value="A">Año(s)</option>
                    </select>
                </div>
            </div>
    
            <div class="grid grid-cols-3 gap-4">
                <div>
                    <label for="valor_texto" class="block text-sm font-medium text-gray-700">Valor texto</label>
                    <input id="valor_texto" name="valor_texto" type="text" wire:model="valorReferencia.valor_texto" class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>
                <div>
                    <label for="valor_inicial" class="block text-sm font-medium text-gray-700">Valor inicial</label>
                    <input id="valor_inicial" name="valor_inicial" type="number" step="any" wire:model="valorReferencia.valor_inicial" class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>
                <div>
                    <label for="valor_final" class="block text-sm font-medium text-gray-700">Valor final</label>
                    <input id="valor_final" name="valor_final" type="number" step="any" wire:model="valorReferencia.valor_final" class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>
            </div>
    
            <div class="mb-2">
                <label for="nota_predefinida" class="block text-sm font-medium text-gray-700">Nota predefinida</label>
                <input id="nota_predefinida" name="nota_predefinida" type="text" wire:model="valorReferencia.nota_predefinida" class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>
    
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="altura_inicial" class="block text-sm font-medium text-gray-700">Altura inicial</label>
                    <input id="altura_inicial" name="altura_inicial" type="text" wire:model="valorReferencia.altura_inicial" class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>
                <div>
                    <label for="altura_final" class="block text-sm font-medium text-gray-700">Altura final</label>
                    <input id="altura_final" name="altura_final" type="text" wire:model="valorReferencia.altura_final" class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>
    
            </div>
            <!-- Aquí puedes agregar más campos -->
            <button type="submit" class="w-full py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-teal-600 hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Guardar</button>
        </form>
    </div>
   
    @endif
    @endif
</div>
