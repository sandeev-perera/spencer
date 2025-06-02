<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CheckoutController extends Controller
{
    public function checkout(Request $request)
{
        $data = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone' => 'required|string|regex:/^[0-9]{10}$/',
            'address' => 'required|string|max:500',
            'city' => 'required|string|max:100',
            'district' => 'required|string|max:100',

            'cardholder_name' => 'required|string|max:255',
            'card_number' => 'required|numeric',
            'exp_date' => 'required',
            'cvv' => 'required|numeric|digits:3',
        ]);

        $userId = (string) Auth::id();

        $userCart = Cart::where('user_id', $userId)->first();

        if (!$userCart || !$userCart->cart_items) {
            return back()->withErrors(['cart' => 'Your cart is empty']);
        }

        $full_price = 0;
        foreach ($userCart->cart_items as $item) {
            $productDetails = explode("-", $item['sku']);
            $productID = $productDetails[2];

            $product = Product::where('product_id', (int)$productID)->first();

            if (!$product) {
                return back()->withErrors(['product' => "Product with ID {$productID} not found."]);
            }
            $price = $product['base_price'];
            $foundStock = null;
            foreach ($product->variants as $variant) {
                if (isset($variant['sub_variants'])) {
                    foreach ($variant['sub_variants'] as $subvariant) {
                        if (isset($subvariant['sku']) && $subvariant['sku'] === $item['sku']) {
                            $foundStock = $subvariant['stock_quantity'];
                            break 2;
                        }
                    }
                }
            }

            if ($foundStock === null) {
                return back()->withErrors(['sku' => "SKU {$item['sku']} not found in product variants."]);
            }

            if ($foundStock < $item['quantity']) {
                return back()->withErrors([
                    'stock' => "Insufficient stock for SKU {$item['sku']}. Available: {$foundStock}, Requested: {$item['quantity']}"
                ]);
            }
            $full_price += ($item['quantity'] * $price);
        }

        DB::beginTransaction();

        try {
            foreach ($userCart->cart_items as $item) {
                $productDetails = explode("-", $item['sku']);
                $productID = $productDetails[2];

                $product = Product::where('product_id', (int)$productID)->where('is_active', true)->first();

                $variants = $product->variants;

                foreach ($variants as $variantIndex => $variant) {
                    if (isset($variant['sub_variants'])) {
                        foreach ($variant['sub_variants'] as $subvariantIndex => $subvariant) {
                            if (isset($subvariant['sku']) && $subvariant['sku'] == $item['sku']) {
                                $variants[$variantIndex]['sub_variants'][$subvariantIndex]['stock_quantity'] -= $item['quantity'];

                                $product->variants = $variants;
                                $product->save();

                                break 2;
                            }
                        }
                    }
                }
            }
            
            // 4. Create Order
            $order = Order::create([
                'user_id' => $userId,
                'name' => $data['first_name']." ".$data['last_name'],
                'products' => $userCart->cart_items,
                'full_price' => (float)$full_price,
                'phone' => $data['phone'],
                'address' => $data['address'],
                'city' => $data['city'],
                'district' => $data['district'],
            ]);

            // 5. Create Payment linked to Order
            Payment::create([
                'customer_id' => (string)Auth::id(),
                'order_id' => (string)$order->id,
                'payment_date' => now(),
                'billing_address' => $data['address'] . ', ' . $data['city'] . ', ' . $data['district'],
                'payment_method' => 'card',
                'status' => 'completed',
                'cardholder_name' => $data['cardholder_name'],
            ]);

            DB::commit();

            $userCart->delete();

            return redirect()->route('show.order.complete');

    } catch (\Exception $e) {
        DB::rollBack();
        Log::error('Checkout error: ' . $e->getMessage());
        return back()->withErrors(['error' => 'An error occurred during checkout. Please try again.']);
    }
}

}
