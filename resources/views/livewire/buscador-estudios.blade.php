<div>
    {{-- The Master doesn't talk, he acts. --}}
    <input type="text" wire:model.live="search" placeholder="Buscar estudio..." class="form-control rounded-md shadow-sm border-gray-300" autofocus>
    <hr>
    <div wire:loading>Buscando...</div>
    @if ($studies)
        <ul>
            @foreach ($studies as $study)
                <li wire:click="selectStudy({{$study->id}})" class="hover:bg-teal-200 text-blue" >{{$study->id}} - {{$study->nombre}}</li>
            @endforeach
        </ul>
    @endif
</div>
