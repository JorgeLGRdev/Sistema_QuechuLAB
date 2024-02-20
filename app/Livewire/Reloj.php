<?php

namespace App\Livewire;

use Livewire\Component;

class Reloj extends Component
{

    public $date;
    public $time;

    public function mount()
    {
        $this->date = \App\Helpers\Helpers::formatFecha(date('Y-m-d'));
        $this->time = date('H:i:s');
    }

    public function refreshTime()
    {
        $this->time = date('H:i:s');
    }

    public function render()
    {
        return view('livewire.reloj');
    }
}
