<?php

namespace App\Livewire;

use App\Models\Detalle_Orden;
use App\Models\Estudio;
use App\Models\Resultado;
use Livewire\Component;

class ReportesEspeciales extends Component
{

    public $estudio;
    public $detalle_orden;
    public $resultados;
    public $parametros;

    protected $listeners = [
        'capturarResultados-RE' => 'loadData',
        'ordenSeleccionada' => 'resetData',
        'ordenNoEncontrada' => 'resetData',
        'capturarResultados'=> 'resetData',
        'validarResultados'=> 'resetData',
    ];

    public function resetData(){
        $this->estudio=null;
        $this->detalle_orden=null;
        $this->resultados=null;
        $this->parametros=null;
    }

    public function loadData($estudio_id, $orden_id)
    {   
        $this->estudio = Estudio::find($estudio_id);
        $this->detalle_orden = Detalle_Orden::find($orden_id);
        $this->parametros = collect(); //opcional
        $this->fillForm();
        //cerrar captura de resultados si esta cargado
    }

    public function fillForm(){
        $resultados = Resultado::where('detalle_orden_id', $this->detalle_orden->id)
                        ->where('estudio_id', $this->estudio->id)
                        ->get();
        if($resultados->isEmpty()){
            $file = base_path("database/data/reporte_especial_" . $this->estudio->id . ".csv");
            $data = array_map('str_getcsv', file($file));
            foreach ($data as $row) {
                $resultado = Resultado::Create(
                    [
                    'parametro' => $row[0],
                    'resultado' => '',
                    'unidades' => $row[1],
                    'val_ref_texto' => $row[2],
                    'val_ref_inicial' => $row[3],
                    'val_ref_final' => $row[4],
                    'estudio_id' => $this->estudio->id,
                    'detalle_orden_id' => $this->detalle_orden->id
                    ] // valores para actualizar o crear
                );
            }
            $resultados = Resultado::where('detalle_orden_id', $this->detalle_orden->id)
                        ->where('estudio_id', $this->estudio->id)
                        ->get();
        }
        $this->parametros = $resultados;
        foreach($this->parametros as $parametro){
            if($parametro->val_ref_texto != '' || $parametro->val_ref_inicial != '' || $parametro->val_ref_final != ''){
                $this->resultados[$parametro->id] = $parametro->resultado;
            }
        }
    }

    public function guardarResultados(){
        foreach($this->resultados as $resultadoId => $resultado) {
            Resultado::updateOrCreate(
                ['id' => $resultadoId], // columnas para buscar
                ['resultado' => $resultado,
                'estudio_id' => $this->estudio->id,
                'detalle_orden_id' => $this->detalle_orden->id] // valores para actualizar o crear
            );
        }
        $this->detalle_orden->update(['estado' => 'resultados']);
        $this->dispatch('updateDetalleOrden', $this->detalle_orden->id);
        $this->resetForm();
    }

    public function resetForm(){
        $this->estudio=null;
        $this->detalle_orden=null;
        $this->resultados=null;
        $this->parametros=null;
    }

    public function render()
    {
        return view('livewire.reportes-especiales');
    }
}
