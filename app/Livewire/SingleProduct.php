<?php

namespace App\Livewire;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use MongoDB\Laravel\Eloquent\Casts\ObjectId;

class SingleProduct extends Component
{
    public $variant = null;
    public $selectedVariant;

    public $selectedSize;
    public $selectedQuantity = 1;

    public $image;

    public $message;

    public $messageColor;
    public $selectedColor;
    public $product;

    public function mount($id)
    {
        Log::info($id);
        $this->product = Product::where("product_id", (int) $id)->firstOrFail();
        $this->image = $this->product["thumbnail_image"];

    }

    public function selectColor($color, $index)
    {
        $this->selectedColor = $color;
        $this->image = $this->product["variants"][$index]['images'][0];
    }

    public function selectSize($size)
    {
        $this->selectedSize = $size;
    }

    public function render()
    {
        $product = $this->product;
        return view('livewire.single-product', compact('product'));
    }

    public function addToCart()
    {
        if (!Auth::check()) {
            $this->message = "Please Login to maintain a cart";
            $this->messageColor = "bg-red-100 text-red-700";
            return;
        }

        if (!$this->selectedColor || !$this->selectedSize) {
            $this->message = 'Please select both a color and a size.';
            $this->messageColor = 'bg-red-100 text-red-700';
            return;
        }

        $variant = collect($this->product['variants'])->firstWhere('color', $this->selectedColor);
        if (!$variant) {
            $this->message = 'Selected color not found.';
            $this->messageColor = 'bg-red-100 text-red-700';
            return;
        }

        $subVariant = collect($variant['sub_variants'])->firstWhere('size', $this->selectedSize);
        if (!$subVariant) {
            $this->message = 'Selected size not available for this color.';
            $this->messageColor = 'bg-red-100 text-red-700';
            return;
        }

        $stock = (int) ($subVariant['stock_quantity'] ?? 0);
        if ($stock < $this->selectedQuantity) {
            $this->message = 'Not enough stock available. Available: ' . $stock;
            $this->messageColor = 'bg-red-100 text-red-700';
            return;
        }

        $userId = Auth::id();
        $cart = Cart::firstOrCreate(
            ['user_id' => $userId],
            ['cart_items' => []]
        );

        $cartItems = $cart->cart_items ?? [];

        $existingItemIndex = collect($cartItems)->search(function ($item) use ($subVariant) {
            return $item['sku'] === $subVariant['sku'];
        });

        if ($existingItemIndex !== false) {
            if ($cartItems[$existingItemIndex]['quantity'] + (int) $this->selectedQuantity > $stock) {
                $this->message = 'Not enough stock available. Available: ' . $stock;
                $this->messageColor = 'bg-red-100 text-red-700';
                return;
            }
            $cartItems[$existingItemIndex]['quantity'] += (int) $this->selectedQuantity;
            $cartItems[$existingItemIndex]['price'] = (float) $this->product['base_price'];
        } else {
            $cartItems[] = [
                'sku' => $subVariant['sku'],
                'quantity' => (int) $this->selectedQuantity,
                'price' => (float) $this->product['base_price']
            ];
        }

        $cart->cart_items = $cartItems;
        $cart->save();

        $this->message = 'Product added to cart successfully.';
        $this->messageColor = 'bg-green-100 text-green-700';

        $this->selectedColor = null;
        $this->selectedSize = null;
        $this->selectedQuantity = 1;
    }

}
