<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Paciente;

class Pacientes extends Component
{
    public $busqueda = '';
    public $pacienteSeleccionado;
    public $dato;

    protected $listeners = ['ordenRegistrada' => 'resetData'
    ];

    public function resetData(){
        $this->pacienteSeleccionado=null;
    }

    public function render()
    {
        $resultados = [];

        if (!empty($this->busqueda)) {
            $resultados = Paciente::where('nombre', 'like', '%' . $this->busqueda . '%')->get();
        }

        return view('livewire.pacientes', ['resultados' => $resultados]);
    }

    public function seleccionarPaciente($pacienteId)
    {
        $this->pacienteSeleccionado = Paciente::find($pacienteId);
        $this->busqueda = ''; 
        $this->dispatch('pacienteSeleccionado', $pacienteId );
    }

}
