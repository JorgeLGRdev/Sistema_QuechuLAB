<?php

namespace App\Livewire;

use Livewire\Component;

class Doctor extends Component
{
    public $doctor;

    protected $listeners = ['ordenRegistrada' => 'resetData'
    ];

    public function resetData(){
        $this->doctor='';
    }

    public function updatedDoctor()
    {   
        $this->dispatch('doctorUpdated', $this->doctor);
    }

    public function render()
    {
        return view('livewire.doctor', ['doctor' => $this->doctor]);
    }
}
