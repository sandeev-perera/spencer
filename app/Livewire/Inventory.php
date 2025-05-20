<?php

namespace App\Livewire;

use Livewire\Component;

class Inventory extends Component
{
    public $selectedSection;
    public $show;
    public function render()
    {
        return view('livewire.inventory',
    [
            'selectedSection' => $this->selectedSection,
            'show' => $this->show
        ]);
    }
}
