<?php

namespace App\Livewire;

use App\Models\Product;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class SingleProduct extends Component
{
     public $variant = null;
    public $selectedVariant;
    public $product;

    public function mount($id){
        Log::info($id);
        $this->product = Product::where("product_id", (int) $id)->firstOrFail();
    }
    
    public function render()
    {
        $product = $this->product;
        return view('livewire.single-product', compact('product'));
    }
}
