<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Detalle_Orden;

class BuscadorOrdenes extends Component
{
    public $busquedaOrden = '';

    public function updatedBusquedaOrden()
    {
        $orden = Detalle_Orden::find($this->busquedaOrden);
        if($orden){
          //  $this->busquedaOrden = ''; 
            $this->dispatch('ordenSeleccionada', $orden->id);
        }else{
            $this->dispatch('ordenNoEncontrada');
        }
  
    }

    public function render()
    {
       // $resultados = [];
       // if (!empty($this->busquedaOrden)) {
       //     $resultados = Detalle_Orden::where('id', 'like', '%' . $this->busquedaOrden . '%')->get();
       // }
        
       // return view('livewire.buscador-ordenes', ['resultados' => $resultados]);
       return view('livewire.buscador-ordenes');

    }


    public function seleccionarOrden($ordenId)
    {
        $this->busquedaOrden = ''; 
        $this->dispatch('ordenSeleccionada', $ordenId );
    }
}
