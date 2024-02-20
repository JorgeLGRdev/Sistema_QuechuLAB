<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\ValorReferencia;
use App\Models\Estudio;

class FormularioVR extends Component
{
    public $estudio; 
    public $valorReferencia = [];
    public $onEdit=false;
    public $valRef;

    protected $listeners = ['estudioSeleccionado' => 'loadData',
    'editarValorDeReferencia' => 'editValRef'];

    public function editValRef($val_ref_id)
    {
        $this->onEdit = true;
        $this->valRef = ValorReferencia::find($val_ref_id);
        $this->valorReferencia['estudio_id'] = $this->estudio->id;;
        $this->valorReferencia['sexo'] = $this->valRef->sexo; 
        $this->valorReferencia['edad_inicial'] = $this->valRef->edad_inicial; 
        $this->valorReferencia['periodo_inicial'] = $this->valRef->periodo_inicial; 
        $this->valorReferencia['edad_final'] = $this->valRef->edad_final; 
        $this->valorReferencia['periodo_final'] = $this->valRef->periodo_final; 
        $this->valorReferencia['valor_texto'] = $this->valRef->valor_texto; 
        $this->valorReferencia['valor_inicial'] = $this->valRef->valor_inicial; 
        $this->valorReferencia['valor_final'] = $this->valRef->valor_final; 
        $this->valorReferencia['nota_predefinida'] = $this->valRef->nota_predefinida; 
        $this->valorReferencia['altura_inicial'] = $this->valRef->altura_inicial; 
        $this->valorReferencia['altura_final'] = $this->valRef->altura_inicial; 
        // debe estar en tablaVR tambien
    }

    public function loadData($estudioId)
    {
        $this->estudio = Estudio::find($estudioId);
        $this->resetForm();
    }

    public function resetForm()
    {
        $this->valorReferencia['estudio_id'] = $this->estudio->id;;
        $this->valorReferencia['sexo'] = 'G'; 
        $this->valorReferencia['periodo_inicial'] = 'A'; 
        $this->valorReferencia['periodo_final'] = 'A'; 
        $this->onEdit=false; //newcode

    }

    public function save() 
    {
        if($this->onEdit){ //editing
            ValorReferencia::updateOrCreate(
                ['id' => $this->valRef->id],
                $this->valorReferencia);
            $this->onEdit=false; //after an update
        }else{ //creating
            ValorReferencia::create($this->valorReferencia);
        }

         // Limpia el formulario
        $this->valorReferencia = [];
        $this->resetForm();

        // Emite un evento
        $this->dispatch('valorReferenciaGuardado');
    }

    public function render()
    {
        return view('livewire.formulario-v-r');
    }
}
