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

class ValidacionResultados extends Component
{
    public $orden;
    public $estudios;
    public $valores_referencia;
    public $resultados;

    protected $listeners = ['validarResultados' => 'loadData',
        'ordenSeleccionada' => 'resetData',
        'ordenNoEncontrada' => 'resetData',
        'capturarResultados' => 'resetData',
        'capturarResultados-RE' => 'resetData'
    ];

    public function loadData($ordenId)
    {
        $this->orden = Detalle_Orden::find($ordenId);
        $ordenes = Orden::where('detalle_orden_id',$this->orden->id)->get();
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
                    $this->estudios->push($estudio);
                    //Valores de referencia
                    $referencias = ValorReferencia::where('estudio_id', $estudio->id)->get();
                    $this->valores_referencia->push($referencias);
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
        if($this->orden->estado != 'espera' ){
            $resultados = Resultado::where('detalle_orden_id', $this->orden->id)->get();
            foreach($resultados as $resultado){
                $this->resultados[$resultado->estudio_id] = $resultado->resultado;
            }
        }
    }

    public function resetData()
    {
        $this->estudios = null;
        $this->valores_referencia = null;
        $this->resultados = null;
        $this->orden = null;
    }

    public function guardarValidacion(){
        $this->orden->update(['estado' => 'validados']);
        $this->dispatch('updateDetalleOrden', $this->orden->id);
        $this->resetData();
    }

    public function render()
    {
        return view('livewire.validacion-resultados');
    }
}
