<div>

    <div class="grid grid-cols-2 gap-4">
        <div>
            @livewire('pacientes',['dato' => $datoPadre])
        </div>

        <div>
            @livewire('doctor')
            @livewire('reloj')

        </div>
    </div>
    
    <div>
        @livewire('estudios')

        <button wire:click="registrarOrden" class="flex-shrink-0 bg-teal-500 hover:bg-teal-700 border-teal-500 hover:border-teal-700 text-sm border-4 text-white py-1 px-2 rounded">
            Registrar Orden
        </button>
        
    </div>
            
</div>
