<?php

namespace App\Livewire;

use App\Models\Order;
use Livewire\Component;

class Orders extends Component
{

    public $selectedSection;
    public $show;
    public function render()
    {
        $orders = Order::paginate(10);
        return view('livewire.orders',
    [
            'selectedSection' => $this->selectedSection,
            'show' => $this->show,
            "orders" => $orders
        ]);
    }


}
