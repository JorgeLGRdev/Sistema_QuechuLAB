<?php

namespace App\Livewire;

use App\Models\Estudio;
use Livewire\Component;

class DetalleEstudio extends Component
{
    public $estudio;

    protected $listeners = ['estudioSeleccionado' =>'loadData'];

    public function loadData($id){
        $this->estudio = Estudio::find($id);
    }

    public function render()
    {
        return view('livewire.detalle-estudio');
    }
}
