<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

use function Livewire\Volt\protect;

class CustomerProfileController extends Controller
{
    public $orders = [];
    public function show(){
        $userId = (string)Auth::id();
        $orders = Order::where('user_id', $userId)->orderBy('created_at', "desc")->paginate(5);
        Log::info($orders);
        return view('customer-profile', compact("orders"));

    }
}
