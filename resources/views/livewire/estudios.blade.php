
<div>

    <div class="grid grid-cols-2 gap-4">
        <div>
            <input id="study" type="text" wire:model.live="study" placeholder="Buscar estudios..." class="form-control rounded-md shadow-sm border-gray-300">
        </div>
       
        <div>
        </div>
    </div>

    <hr>
        @if ($study)
            @if ($studies->isNotEmpty())
                <ul>
                    @foreach ($studies as $study)
                        <li wire:click="select({{ $study->id }})" class="hover:bg-teal-200 text-blue">
                            {{ $study->nombre }} - {{ $study->precio }}
                        </li>
                    @endforeach
                </ul>
            @else
                <p>No se encontraron resultados</p>
            @endif
        @endif

    <table class="w-full text-sm text-left text-gray-500">
        <thead class="bg-teal-500 text-white">
            <tr class="hover:bg-teal-700">
                <th class="px-4 py-2">Estudio</th>
                <th class="px-4 py-2">Precio</th>
                <th class="px-4 py-2">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($selected as $index => $study)
                <tr class="bg-white hover:bg-teal-100">
                    <td class="border px-4 py-2">{{ $study->nombre }}</td>
                    <td class="border px-4 py-2">{{ $study->precio }}</td>
                    <td class="border px-4 py-2">
                        <button wire:click="quitarEstudio({{ $index }})" class="text-red-500 hover:text-red-700">Quitar</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    
    <div class="flex items-center border-b border-teal-500 py-2">
        <span>TOTAL:</span>
        <input class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none" type="text" placeholder="Total" aria-label="Total" readonly wire:model="total">
 
    </div>
    

</div>