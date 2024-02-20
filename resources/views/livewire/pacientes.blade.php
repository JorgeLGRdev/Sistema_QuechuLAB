<div>
    <input type="text" wire:model.live="busqueda" placeholder="Buscar paciente..." class="form-control rounded-md shadow-sm border-gray-300">
    <hr>
    <ul>
        @foreach($resultados as $paciente)
            <li wire:click="seleccionarPaciente({{ $paciente->id }})" class="hover:bg-teal-200 text-blue">
                {{ $paciente->nombre }}
            </li>
        @endforeach
    </ul>

    @if($pacienteSeleccionado)
    <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        <h2 class="font-bold text-xl mb-2">Datos del Paciente:</h2>
        <p class="mb-2"><span class="font-semibold">Nombre:</span> {{ $pacienteSeleccionado->nombre }} {{ $pacienteSeleccionado->apellido_paterno }} {{ $pacienteSeleccionado->apellido_materno }}</p>
        <p class="mb-2"><span class="font-semibold">Sexo:</span> {{ ($pacienteSeleccionado->sexo == 'M') ? 'Masculino':'Femenino' }}</p>
        <p class="mb-2"><span class="font-semibold">Edad:</span> {{ \App\Helpers\Helpers::obtenerEdad($pacienteSeleccionado->fecha_nacimiento) }}</p>
    </div>
    @endif
</div>
