<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Log;
use Livewire\Component;

class Overview extends Component
{
    public $selectedSection;
    public $show;
    public function render()
    {
        Log::info("this Runs Too");
        return view('livewire.overview',[
            'selectedSection' => $this->selectedSection,
            'show' => $this->show,
        ]);
    }
}
