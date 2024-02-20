<?php

namespace App\Livewire;

use App\Models\Detalle_Orden;
use App\Models\Detalle_Perfil;
use App\Models\Estudio;
use App\Models\Orden;
use App\Models\Perfil;
use App\Models\Resultado;
use App\Models\ValorReferencia;
use Livewire\Component;

class ResultadosForm extends Component
{
    public $detalle_orden; 
    public $estudios; //lista de esutdios en la orden
    public $resultados = [];
    public $valores_referencia;
    public $validacion = false;

    protected $listeners = ['capturarResultados' => 'loadForm',
    'ordenSeleccionada' => 'resetForm',
    'ordenNoEncontrada' => 'resetForm',
    'validarResultados' => 'validarResultados',
    'capturarResultados-RE' => 'resetForm'
    ];

    public function loadForm($ordenId){
        $this->validacion=false;// newcode
        $this->detalle_orden = Detalle_Orden::find($ordenId);
        $ordenes = Orden::where('detalle_orden_id', $ordenId)->get();
        $this->estudios = collect();
        $this->valores_referencia = collect();

        foreach($ordenes as $orden){
            $estudio = Estudio::find($orden->estudio_id);
            //si no es perfil
            if($estudio->es_perfil == "n"){            
                if($estudio->reporte_especial != "S"){ //si no es reporte especial
                    $this->estudios->push($estudio);
                    //Valores de referencia
                    $referencias = ValorReferencia::where('estudio_id', $estudio->id)->get();
                    $this->valores_referencia->push($referencias);
                }else{  //si es reporte especial

                }
            }else{//si es perfil
                $detalle_perfil = Detalle_Perfil::where('nombre', $estudio->nombre)->first();
                $perfiles = Perfil::where('detalle_perfil_id', $detalle_perfil->id)->get();
                foreach($perfiles as $perfil){
                    $estudioAux = Estudio::find($perfil->estudio_id);
                    $this->estudios->push($estudioAux);
                    //Valores de referencia
                    $referencias = ValorReferencia::where('estudio_id', $estudioAux->id)->get();
                    $this->valores_referencia->push($referencias);
                }
            }
        }
        $this->cargarResultados();
    }

    public function cargarResultados()
    { 
        if($this->detalle_orden->estado != 'espera' ){
            $resultados = Resultado::where('detalle_orden_id', $this->detalle_orden->id)->get();
            foreach($resultados as $resultado){
                $this->resultados[$resultado->estudio_id] = $resultado->resultado;
            }
        }
    }

    public function guardarResultados()
    {
        foreach($this->resultados as $estudioId => $resultado) {
            Resultado::updateOrCreate(
                ['detalle_orden_id' => $this->detalle_orden->id, 'estudio_id' => $estudioId], // columnas para buscar
                ['resultado' => $resultado,
                'estudio_id' => $estudioId,
                'detalle_orden_id' => $this->detalle_orden->id] // valores para actualizar o crear
            );
        }

        $this->detalle_orden->update(['estado' => 'resultados']);
        $this->dispatch('updateDetalleOrden', $this->detalle_orden->id);
        $this->resetForm();

        //session()->flash('message', 'Los resultados se han guardado con éxito.');
    }

    public function validarResultados($orden_id)
    {
        $this->resetForm();
        //$this->loadForm($orden_id);
        //$this->validacion = true; //movedcode
      //  $this->render();
    }

    public function guardarValidacion(){
        $this->detalle_orden->update(['estado' => 'validados']);
        $this->dispatch('updateDetalleOrden', $this->detalle_orden->id);
        $this->resetForm();
    }

    public function resetForm()
    {
        $this->resultados = [];
        $this->estudios = null;
        $this->valores_referencia = null;
        $this->detalle_orden=null;

        $this->validacion=false;//newcode
    }

    public function generarInformeDeResultados(){
        
    }

    public function render()
    {
        return view('livewire.resultados-form');
    }
}
