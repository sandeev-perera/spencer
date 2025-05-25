<?php

namespace App\Livewire;

use App\Models\Cart as ModelsCart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class Cart extends Component
{
    public $cart = [
        "cart_items" => []
    ];
    public function mount()
    {
        $cart = $this->findCart();
        
        if ($cart) {
            $this->cart = $cart->toArray();
            foreach($this->cart["cart_items"] as $cartItemIndex => $cartItem){
                $values = explode("-",$cartItem["sku"]);
                $product = Product::where('product_id',(int)$values[2])->select( 'thumbnail_image', 'name')->first();
                if($product){
                    $this->cart['cart_items'][$cartItemIndex]['size'] = $values[1];
                    $this->cart['cart_items'][$cartItemIndex]['color'] = $values[0];
                    $this->cart['cart_items'][$cartItemIndex]['product_id'] = (int)$values[2];
                    $this->cart['cart_items'][$cartItemIndex]['name'] = $product->name;
                    $this->cart['cart_items'][$cartItemIndex]['thumbnail_image'] =  $product->thumbnail_image;
                }
            }
        } else {
            Log::info('No cart found for this user ID');
        }
    }

    public function render()
    {
        return view('livewire.cart');
    }

    public function removeItem($index){
        unset($this->cart['cart_items'][$index]);
        $this->cart["cart_items"] = array_values($this->cart['cart_items']); 
        $cart = $this->findCart(); 

        if ($cart) {
            $cart->cart_items = $this->cart['cart_items'];
            $cart->save();
        }
    }

    private function findCart(){
        $user_id = (string) Auth::id();
        $cart = ModelsCart::firstWhere('user_id', $user_id);
        return $cart;
    }
}
