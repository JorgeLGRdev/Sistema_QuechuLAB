<?php

namespace App\Livewire;

use App\Models\Detalle_Perfil;
use Livewire\Component;
use App\Models\Estudio;
use App\Models\Perfil;

class Estudios extends Component
{
    public $study; // El valor del cuadro de búsqueda
    public $studies; // La colección de estudios que coinciden con la búsqueda
    public $selected; // La colección de estudios que se han seleccionado
    public $total = 0; // La suma total de los precios de los estudios seleccionados

    public function mount()
    {
        $this->studies = collect();
        $this->selected = collect();
    }

    protected $listeners = ['ordenRegistrada' => 'resetData'
    ];

    public function resetData(){
        $this->studies = collect();
        $this->selected = collect();
        $this->total = 0;
    }

    public function updatedStudy($value)
    {
        // Hacer la consulta a la base de datos con el valor de $study
        $this->studies = Estudio::where('nombre', 'like', '%' . $value . '%')->get();
    }

    public function select($id)
    {
        // Agregar el estudio con el id dado a la colección de seleccionados
        $study = Estudio::find($id);
        $this->selected->push($study);

        $this->dispatch('estudioSeleccionado', $id); //envia id del estudio seleccionado

        // Sumar el precio del estudio seleccionado al total
        $this->total += $study->precio;
        $this->dispatch('actualizarTotal', $this->total);

        // Limpiar el cuadro de búsqueda y las sugerencias
        $this->study = '';
        $this->studies = collect();

    }

    public function quitarEstudio($index)
    {
        // Restar el precio del estudio que se va a quitar del total
        $this->total -= $this->selected[$index]->precio;
        $this->dispatch('actualizarTotal', $this->total);

        // Quitar el estudio de la colección de seleccionados
        $this->selected = $this->selected->forget($index);

        $this->dispatch('quitarEstudio', $index); //envia id del estudio seleccionado
    }

    public function render()
    {
        return view('livewire.estudios');
    }
}