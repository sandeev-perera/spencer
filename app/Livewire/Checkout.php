<?php

namespace App\Livewire;

use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class Checkout extends Component
{
    public $price = 0;
    
    public function render()
    {
        return view('livewire.checkout');
    }

    public function mount(){
        $cart = Cart::where('user_id', Auth::id())->first();
        $value = 0;
        if ($cart && $cart->cart_items) {
            foreach ($cart->cart_items as $item) {
                $value += (float)($item['price'] ?? 0) * (int)($item['quantity'] ?? 0); 
            }
            $this->price = $value;
        }
        else{
            abort(403);
        }
    }
}
