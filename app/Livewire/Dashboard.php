<?php

namespace App\Livewire;

use App\Models\Detalle_Orden;
use Livewire\Component;

class Dashboard extends Component
{
    public $date;
    public $time;
    public $ordenesDelDia;

    public function mount()
    {
        $this->date = \App\Helpers\Helpers::formatFecha(date('Y-m-d'));
        $this->time = date('H:i:s');
        $this->ordenesDelDia = Detalle_Orden::whereDate('created_at', date('Y-m-d'))->get();
    }

    public function refreshTime()
    {
        $this->time = date('H:i:s');
    }

    public function render()
    {
        return view('livewire.dashboard');
    }
}
