<?php

namespace App\Livewire;

use App\Models\Estudio;
use Livewire\Component;
use App\Models\ValorReferencia;

class TablaVR extends Component
{
    public $estudio;//recibe el estudio
    protected $listeners = ['valorReferenciaGuardado' => 'render',
    'estudioSeleccionado' => 'loadData'];

    public function loadData($estudioId)
    {
        $this->estudio = Estudio::find($estudioId);
    }

    public function eliminar($id)
    {
        $valorReferencia = ValorReferencia::find($id);

        if ($valorReferencia) {
            $valorReferencia->delete();
        }

        // Puedes agregar aquí código para manejar lo que sucede después de eliminar el valor de referencia
    }

    public function editar($id)
    {
        $this->dispatch('editarValorDeReferencia',$id);
    }

    public function render()
    {
        $valoresReferencia = null;
        if($this->estudio){
            $valoresReferencia = ValorReferencia::where('estudio_id', $this->estudio->id)->get();
        }
    return view('livewire.tabla-v-r', ['valoresReferencia' => $valoresReferencia]);
    }


}
