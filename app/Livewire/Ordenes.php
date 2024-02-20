<?php

namespace App\Livewire;

use App\Models\Detalle_Orden;
use Livewire\Component;
use App\Models\Orden;
use App\Models\Paciente;

class Ordenes extends Component
{
    public $pacienteSeleccionado;
    public $estudiosSeleccionados;
    public $datoPadre = 'Hola';
    public $total = 0;
    public $doctor = 'A quien corresponda';

    public $orden = [];

    protected $listeners = [
        'pacienteSeleccionado' => 'handlePacienteSeleccionado',
        'estudioSeleccionado' => 'handleEstudioSeleccionado',
        'quitarEstudio' => 'handleQuitarEstudio',
        'actualizarTotal' => 'handleActualizarTotal',
        'doctorUpdated' => 'updateDoctor',
    ];
 
    public function handlePacienteSeleccionado($paciente)
    {
        $this->pacienteSeleccionado = Paciente::find($paciente);
    }

    public function handleEstudioSeleccionado($estudio)
    {
        $this->estudiosSeleccionados[] = $estudio;
    }

    public function handleQuitarEstudio($index)
    {
        if($index !== false){
            unset($this->estudiosSeleccionados[$index]);
        }
    }

    public function handleActualizarTotal($total)
    {
        $this->total = $total;
    }

    public function updateDoctor($newDoctor)
    {
        if($newDoctor != ''){
            $this->doctor = $newDoctor;
        }else{
            $this->doctor = 'A quien corresponda';
        }
    }

    public function registrarOrden()
    {
        if($this->pacienteSeleccionado){
            if($this->estudiosSeleccionados){
                // registrar el detalle de la orden en la base de datos    
                $detalle_orden = Detalle_Orden::create([
                    'total' => $this->total,
                    'doctor' => $this->doctor,
                    'estado' => 'espera',
                    'paciente_id' => $this->pacienteSeleccionado->id,
                ]);
                        
                foreach($this->estudiosSeleccionados as $estudio){
                    Orden::create([
                        'detalle_orden_id' => $detalle_orden->id,
                        'estudio_id' => $estudio,
                    ]);
                }
                $this->dispatch('ordenRegistrada');
                $this->resetData();
                return redirect()->route('generate-pdf', $detalle_orden->id);
            }
        }
    }   

    public function resetData(){
        $this->pacienteSeleccionado = null;
        $this->estudiosSeleccionados = [];
        $this->total=0;
        $this->doctor = 'A quien corresponda';
        $this->orden = [];
    }

    public function render()
    {
        return view('livewire.ordenes');
    }
}
