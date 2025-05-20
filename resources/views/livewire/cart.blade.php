@extends('layouts.app')
@section('title', 'Cart')
@section('content')

<div class="bg-gradient-to-b from-red-600 to-gray-900 min-h-screen py-8">

    <div class="container mx-auto p-6 min-h-[50vh]">
        <h1 class="text-4xl font-bold mb-6 text-white">Shopping Cart</h1>

        {{-- @if (!session()->has('SignedIn'))
            <p class="text-center text-red-300 font-semibold">You need to log in to view your cart.</p>
        @else --}}

            <div class="flex flex-col lg:flex-row gap-6">
                <!-- Cart Items -->
                <div class="w-full lg:w-2/3 bg-white p-6 rounded-lg shadow-md">
                    <h2 class="text-xl font-semibold mb-4">Your Items</h2>

                    @if (session()->has('message'))
                        <div class="bg-black text-white p-3 rounded-md shadow-md mb-4">
                            <p>{{ session('message') }}</p>
                        </div>
                        @php session()->forget('message'); @endphp
                    @endif

                    @php
                        $items = [
                            ['name' => 'Nike Shoes', 'size' => 'Medium', 'price' => 5000, 'quantity' => 2],
                            ['name' => 'Adidas Pro', 'size' => 'Large', 'price' => 6000, 'quantity' => 1],
                            ['name' => 'Puma Flex', 'size' => 'Small', 'price' => 4500, 'quantity' => 3],
                            ['name' => 'Reebok Classic', 'size' => 'XL', 'price' => 5200, 'quantity' => 1],
                        ];
                    @endphp

                    @foreach($items as $index => $item)
                        <div class="cart-item flex items-center justify-between border-b pb-4 mb-4">
                            <div class="flex items-center space-x-4">
                                <img src="https://static.nike.com/a/images/t_PDP_936_v1/f_auto,q_auto:eco/30d7afaa-343b-4439-b65d-bb544c65420e/NIKE+REVOLUTION+7.png"
                                    alt="Product Image" class="w-20 h-20 object-cover rounded">
                                <div>
                                    <h3 class="text-lg font-medium text-gray-800">{{ $item['name'] }}</h3>
                                    <p class="text-gray-600">Size: <span class="font-semibold">{{ $item['size'] }}</span></p>
                                    <p class="text-gray-600">Price: <span class="font-semibold">${{ number_format($item['price']) }} x {{ $item['quantity'] }}</span></p>
                                    <p class="text-gray-600">Total: <span class="font-semibold">${{ number_format($item['price'] * $item['quantity']) }}</span></p>
                                </div>
                            </div>
                            <div class="flex items-center space-x-4">
                                <form action="" method="POST" class="flex items-center space-x-4">
                                    <input type="hidden" name="CartID" value="CART{{ $index + 1 }}">
                                    <input type="hidden" name="CartItemID" value="ITEM{{ $index + 1 }}">

                                    <input type="number" name="newQuantity" value="{{ $item['quantity'] }}"
                                           min="1" max="10"
                                           class="w-16 p-2 border rounded text-center focus:outline-none focus:ring-2 focus:ring-blue-500">

                                    <button type="submit"
                                            class="px-4 py-2 bg-black text-white font-semibold rounded-lg shadow-md hover:bg-red-600 transition duration-300">
                                        Update
                                    </button>
                                </form>

                                <a href="#" class="text-red-500 font-semibold hover:text-red-700 transition duration-300">
                                    Remove
                                </a>
                            </div>
                        </div>
                    @endforeach

                </div>

                <!-- Cart Summary -->
                <div class="w-full lg:w-1/3 bg-white p-6 rounded-lg shadow-md">
                    <h2 class="text-xl font-semibold mb-4">Cart Summary</h2>

                    @php
                        $subtotal = collect($items)->sum(fn($item) => $item['price'] * $item['quantity']);
                    @endphp

                    <div class="flex justify-between text-lg font-medium text-gray-700 mb-4">
                        <span>Subtotal</span>
                        <span>${{ number_format($subtotal) }}</span>
                    </div>
                    <div class="flex justify-between text-lg font-medium text-gray-700 mb-4">
                        <span>Shipping</span>
                        <span>Free</span>
                    </div>
                    <hr class="my-4">
                    <div class="flex justify-between text-xl font-semibold text-gray-800">
                        <span>Total</span>
                        <span>${{ number_format($subtotal) }}</span>
                    </div>

                    <button onclick="window.location.href='payment.php';"
                        class="w-full bg-gray-900 text-white py-3 rounded-lg text-center font-semibold mt-6 hover:bg-red-600 transition duration-700">
                        Proceed to Checkout
                    </button>

                    @if($subtotal === 0)
                        <p class="text-gray-500 text-center mt-4">Your cart is empty.</p>
                    @endif
                </div>
            </div>
    </div>
</div>

@endsection
