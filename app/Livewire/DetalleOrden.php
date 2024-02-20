<?php

namespace App\Livewire;

use App\Models\Detalle_Orden;
use App\Models\Estudio;
use App\Models\Orden;
use App\Models\Paciente;
use Livewire\Component;

class DetalleOrden extends Component
{
    public $ordenSeleccionada;
    public $paciente;
    public $reportes_especiales;

    protected $listeners = ['ordenSeleccionada' => 'loadData',
    'updateDetalleOrden' => 'loadData',
    'ordenNoEncontrada' => 'resetData'];

    public function resetData(){
        $this->ordenSeleccionada=null;
        $this->paciente=null;
        $this->reportes_especiales=null;
    }

    public function loadData($ordenId){
        $this->ordenSeleccionada = Detalle_Orden::find($ordenId);
        $this->paciente = Paciente::find($this->ordenSeleccionada->paciente_id); //new

        $ordenes = Orden::where('detalle_orden_id', $this->ordenSeleccionada->id)->get();
        $this->reportes_especiales = collect();
        foreach($ordenes as $orden){
            $estudio = Estudio::find($orden->estudio_id);
            if($estudio->reporte_especial  === 'S'){
                $this->reportes_especiales->push($estudio);
            }
        }
       // $this->reportesEspeciales(); //new
    }

    public function capturarResultados($ordenId){
        $this->dispatch('capturarResultados', $ordenId);
    }

    public function validarResultados($ordenId){
        $this->dispatch('validarResultados', $ordenId);
    }

    public function capturarResultadosRE($estudio_id){
        $this->dispatch('capturarResultados-RE', $estudio_id, $this->ordenSeleccionada->id);
    }

    public function render()
    {
        return view('livewire.detalle-orden');
    }
}
