@extends('layouts.app')
@section('title', 'My Profile')
@section('content')

<div class="max-w-screen overflow-x-hidden bg-slate-300">
    <div class="w-full mx-auto text-center min-h-[90vh] pt-10 pb-10 gradient-bg">
        <!-- User Icon -->
        <div class=""></div>
        <div class="flex justify-center">
            <img src="{{ asset('images/icons/CustomerIcon.png') }}" alt="User Icon" class="w-24 h-24 md:w-32 md:h-32">
        </div>

        <!-- User Details -->
        <div class="mt-4 mb-6 text-white">
            <h1 class="text-xl font-semibold">User ID: <span class="font-normal">{{ Auth::id() }}</span></h1>
            <h1 class="text-2xl font-bold mt-2">Username: <span class="font-normal">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</span></h1>
        </div>

        <!-- My Orders (Visible only for Customers) -->
        <div class="w-full max-w-4xl bg-white shadow-lg rounded-lg p-6 mx-auto border border-gray-200 mt-4">
            <h2 class="text-3xl font-bold text-gray-900 mb-6 text-center">My Orders</h2>

            @if($orders->count() > 0)
                <div class="space-y-6">
                    @foreach ($orders as $order)
                        <div class="bg-gray-200 p-4 rounded-lg shadow-md border border-gray-200">
                            <div>
                                <h3 class="text-sm font-semibold text-gray-700 text-left mb-2">Order Date: <span class="text-gray-900">{{ $order->created_at->format('F d, Y') }}</span></h3>
                            </div>

                            <!-- Fetch Order Items -->
                            @foreach ($order->products as $product)
                                <div class="space-y-3">
                                    <div class="flex justify-between items-center bg-white p-3 rounded-lg shadow-sm border">
                                        <div class="text-left">
                                            <p class="text-gray-900 font-medium">{{ $product['sku'] }}</p>
                                        </div>
                                        <p class="text-gray-700 font-semibold">x {{ $product['quantity'] }}</p>
                                    </div>
                                </div>
                            @endforeach

                            <!-- Order Address -->
                            <div class="mt-4 flex justify-between items-center bg-white p-3 rounded-lg shadow-sm border">
                                <p class="text-lg font-semibold text-gray-700">Address:</p>
                                <p class="text-sm text-gray-600">{{ $order->address }}, {{ $order->city }}</p>
                            </div>

                            <!-- Full Payment Section -->
                            <div class="mt-4 flex justify-between items-center bg-white p-3 rounded-lg shadow-sm border">
                                <p class="text-lg font-semibold text-gray-700">Total Payment:</p>
                                <p class="text-xl font-bold text-blue-600">${{ $order->full_price }}</p>
                            </div>
                        </div>
                    @endforeach

                    <!-- Pagination Links -->
                    <div class="mt-6">
                        {{ $orders->links() }}
                    </div>

                </div>
            @else
                <h1 class="text-gray-600">You don't have any orders.</h1>
            @endif
        </div>
    </div>
</div>

@endsection