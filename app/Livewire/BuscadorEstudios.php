<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Estudio;

class BuscadorEstudios extends Component
{
    public $search; // El valor del cuadro de búsqueda

    public function selectStudy($id){
        $this->search = '';
        $this->dispatch('estudioSeleccionado', $id);
    }

    public function render()
    {   
        $studies = null;
        if($this->search != ''){
            $studies = Estudio::where('nombre', 'like', '%' . $this->search . '%')->get();
        }
        return view('livewire.buscador-estudios', ['studies' => $studies]);
    }
}
