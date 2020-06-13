<?php

namespace App\Http\Livewire;

use Livewire\Component;

class EditStep extends Component
{

    public $steps=[];

    public function increment(){
        $this->steps[] = count($this->steps);
    }

    public function remove($i){
        unset($this->steps[$i]);
    }

    public function mount($steps)
    {
        $this->steps = $steps->toArray();
    }

    public function render()
    {
        return view('livewire.edit-step');
    }
}
