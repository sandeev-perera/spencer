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

    public $subtotal = 0;

    public function mount()
    {
        $cart = $this->findCart();

        if ($cart) {
            $this->cart = $cart->toArray();
            foreach ($this->cart["cart_items"] as $cartItemIndex => $cartItem) {
                $values = explode("-", $cartItem["sku"]);
                $product = Product::where('product_id', (int) $values[2])->select('thumbnail_image', 'name')->first();
                if ($product) {
                    $this->cart['cart_items'][$cartItemIndex]['size'] = $values[1];
                    $this->cart['cart_items'][$cartItemIndex]['color'] = $values[0];
                    $this->cart['cart_items'][$cartItemIndex]['product_id'] = (int) $values[2];
                    $this->cart['cart_items'][$cartItemIndex]['name'] = $product->name;
                    $this->cart['cart_items'][$cartItemIndex]['thumbnail_image'] = $product->thumbnail_image;
                }
            }
        $this->subtotal = static::calculateTotal($this->cart);
        } else {
            Log::info('No cart found for this user ID');
        }
    }

    public function render()
    {
        return view('livewire.cart');
    }

    public function removeItem($index)
    {
        unset($this->cart['cart_items'][$index]);
        $this->cart["cart_items"] = array_values($this->cart['cart_items']);
        $this->subtotal = static::calculateTotal($this->cart);
        $cart = $this->findCart();

        if ($cart) {
            $cart->cart_items = $this->cart['cart_items'];
            $cart->save();
        }
    }

    private function findCart()
    {
        $user_id = (string) Auth::id();
        $cart = ModelsCart::firstWhere('user_id', $user_id);
        return $cart;
    }

    private function saveCart($cart = null)
    {
        if ($cart) {
            $updatedItems = [];
            foreach ($this->cart['cart_items'] as $item) {
                $updatedItems[] = [
                    'sku' => $item['sku'],
                    'quantity' => $item['quantity'],
                    "price" => (float) $item['price']
                ];
            }
            $cart->cart_items = $updatedItems;
            $cart->save();
        }
    }

    public function updateCartQuantity($index)
    {
        $quantity = $this->cart['cart_items'][$index]['quantity'] ?? 1;

        if ($quantity < 1 || $quantity > 10) {
            session()->flash("message", "invalid qunatity");
            return;
        }
        $this->cart['cart_items'][$index]['quantity'] = (int) $quantity;
        $this->subtotal = static::calculateTotal($this->cart);

        $cart = $this->findCart();
        $this->saveCart($cart);

        session()->flash('message', 'Quantity updated successfully!');
    }

    
}
