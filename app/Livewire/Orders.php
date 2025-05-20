<?php

namespace App\Livewire;

use Livewire\Component;

class Orders extends Component
{

    public $selectedSection;
    public $show;
    public function render()
    {
        return view('livewire.orders',
    [
            'selectedSection' => $this->selectedSection,
            'show' => $this->show
        ]);
    }
}
