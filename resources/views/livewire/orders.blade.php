<div class="@if($show) block @else hidden @endif bg-white p-6 rounded-lg shadow">
    <div>

    @if (session()->has('message'))
        <div class="mb-4 p-2 bg-green-100 text-green-700 rounded">
            {{ session('message') }}
        </div>
    @endif   

   <div class="orders-container flex flex-wrap gap-6 p-6">
    <!-- Order Card -->
    @foreach ($orders as $order)
        <div class="order-card bg-white border border-gray-200 rounded-lg shadow-lg p-6 w-full md:w-80">
            <h3 class="text-xl font-semibold text-gray-800 mb-4">Order ID: {{ $order->id }}</h3>

            <!-- User Info -->
            <p class="text-sm text-gray-600"><strong>User:</strong> {{ $order->name }}</p>

            <!-- Products Section -->
            <div class="products mt-4">
                <h4 class="font-semibold text-gray-800">Products:</h4>
                @foreach ($order->products as $product)
                    <div class="product-item mb-4 p-4 bg-gray-50 border border-gray-200 rounded-md shadow-sm">
                        <p class="text-gray-700"><strong>SKU:</strong> {{ $product['sku'] }}</p>
                        <p class="text-gray-700"><strong>Quantity:</strong> {{ $product['quantity'] }}</p>
                        <p class="text-gray-700"><strong>Price:</strong> Rs. {{ number_format($product['price'], 2) }}</p>
                    </div>
                @endforeach
            </div>

            <!-- Full Price -->
            <p class="text-lg font-semibold text-gray-800 mt-4"><strong>Full Price:</strong> Rs. {{ number_format($order->full_price, 2) }}</p>

            <!-- Address Info -->
            <div class="address mt-4">
                <p class="text-sm text-gray-600"><strong>Phone:</strong> {{ $order->phone }}</p>
                <p class="text-sm text-gray-600"><strong>Address:</strong> {{ $order->address }}</p>
                <p class="text-sm text-gray-600"><strong>City:</strong> {{ $order->city }}</p>
                <p class="text-sm text-gray-600"><strong>District:</strong> {{ $order->district }}</p>
            </div>

            <!-- Timestamp -->
            <p class="text-sm text-gray-600 mt-4"><strong>Updated At:</strong> {{ $order->updated_at->format('Y-m-d H:i:s') }}</p>

        </div>
    @endforeach
</div>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $orders->links() }}
    </div> 
</div> 

</div>