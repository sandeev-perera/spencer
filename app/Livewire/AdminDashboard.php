<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Log;
use Livewire\Component;

class AdminDashboard extends Component
{
    public $selectedSection = "overview";

    public function setSection($selectedSection){
        $this->selectedSection = $selectedSection;
        Log::info("This Runs ". $this->selectedSection);


    }

    public function render()
    {
        $title= $this->selectedSection;
        Log::info($this->selectedSection);
        return view('livewire.admin-dashboard', ["selectedSection"=> $this->selectedSection,'title' => $title === 'Overview' ? 'Dashboard' : $title,]);
    }
}
