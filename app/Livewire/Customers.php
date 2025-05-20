<?php

namespace App\Livewire;

use Livewire\Component;

class Customers extends Component
{
    public $selectedSection;
    public $show;
    public function render()
    {
        return view('livewire.customers',
    [
            'selectedSection' => $this->selectedSection,
            'show' => $this->show
        ]);
    }
}
