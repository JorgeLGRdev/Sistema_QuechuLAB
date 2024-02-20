<div>
    <div>
        Fecha: {{ $date }}
        Hora: <span wire:poll.1000ms="refreshTime">{{ $time }}</span>    
    </div>
</div>
