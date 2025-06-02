<?php

namespace App\Livewire;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class Overview extends Component
{
    public $selectedSection;
    public $show;

    public $totalcustomers;
    public $totalOrders;
    private $totalRevenue ; 
    private $totalProducts;

    public static function getTotalcustomers(){
        $users = User::where('role', 'customer')->count();
        return (int)$users;
    }

    public function getordersdetails(){
        $orders = Order::count();
        $this->totalOrders = $orders;
        $this->totalRevenue = Order::sum('full_price');

    }

    public function mount(){
        $this->totalcustomers = static::getTotalcustomers();
        $this->getordersdetails();
        $this->totalProducts = Product::where('is_active', true)->count();
    }
    public function render()
    {
        Log::info("this Runs Too");
        return view('livewire.overview',[
            'selectedSection' => $this->selectedSection,
            'show' => $this->show,
            'revenue' =>$this->totalRevenue,
            'orders'=> $this->totalOrders,
            'products' => $this->totalProducts
        ]);
    }
}
