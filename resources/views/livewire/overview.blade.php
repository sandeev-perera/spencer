@if ($show)
<div class="flex-1 p-6 overflow-y-auto">
    {{-- <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold">Overview</h1>
        <div class="flex items-center space-x-4">
            <div class="relative">
                <input type="text" placeholder="Search" class="border rounded-lg py-2 px-4 pl-10">
                [Placeholder]
            </div>
            <button class="border rounded-lg py-2 px-4 flex items-center">
                30 May
                [Placeholder]
            </button>
            <button class="border rounded-lg p-2">
                [Placeholder]
            </button>
        </div>
    </div> --}}

    <!-- Stats -->
    <div class="grid grid-cols-4 gap-6 mb-6">
        <div class="bg-white p-6 rounded-lg shadow">
            <div class="text-sm text-gray-500">Total Revenue</div>
            <div class="text-2xl font-semibold">$82,650</div>
        </div>
        <div class="bg-white p-6 rounded-lg shadow">
            <div class="text-sm text-gray-500">Total Order</div>
            <div class="text-2xl font-semibold">1645</div>

        </div>
        <div class="bg-white p-6 rounded-lg shadow">
            <div class="text-sm text-gray-500">Total Customer</div>
            <div class="text-2xl font-semibold">1,462</div>
            
        </div>
        <div class="bg-white p-6 rounded-lg shadow">
            <div class="text-sm text-gray-500">Pending Delivery</div>
            <div class="text-2xl font-semibold">117</div>
        </div>
    </div>

    <!-- Top Selling Products and Current Offer -->
    <div class="grid grid-cols-2 gap-6">
        <div class="bg-white p-6 rounded-lg shadow">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-lg font-semibold">Top Selling Products</h2>
                <div class="flex space-x-2">
                    <button class="border rounded-lg p-2">
                        [Placeholder]
                    </button>
                    <button class="border rounded-lg p-2">
                        [Placeholder]
                    </button>
                </div>
            </div>
            <div class="grid grid-cols-5 gap-4">
                <div class="text-center">
                    <div class="bg-gray-200 h-32 rounded-lg mb-2 flex items-center justify-center">
                        [Placeholder]
                    </div>
                    <div class="text-sm font-semibold">ly 3</div>
                    <div class="text-sm text-gray-500">752 Pcs</div>
                </div>
                <div class="text-center">
                    <div class="bg-gray-200 h-32 rounded-lg mb-2 flex items-center justify-center">
                        [Placeholder]
                    </div>
                    <div class="text-sm font-semibold">Air Jordan 8</div>
                    <div class="text-sm text-gray-500">752 Pcs</div>
                </div>
                <div class="text-center">
                    <div class="bg-gray-200 h-32 rounded-lg mb-2 flex items-center justify-center">
                        [Placeholder]
                    </div>
                    <div class="text-sm font-semibold">Air Jordan 5</div>
                    <div class="text-sm text-gray-500">752 Pcs</div>
                </div>
                <div class="text-center">
                    <div class="bg-gray-200 h-32 rounded-lg mb-2 flex items-center justify-center">
                        [Placeholder]
                    </div>
                    <div class="text-sm font-semibold">Air Jordan 13</div>
                    <div class="text-sm text-gray-500">752 Pcs</div>
                </div>
                <div class="text-center">
                    <div class="bg-gray-200 h-32 rounded-lg mb-2 flex items-center justify-center">
                        [Placeholder]
                    </div>
                    <div class="text-sm font-semibold">Nike Air Max</div>
                    <div class="text-sm text-gray-500">752 Pcs</div>
                </div>
            </div>
        </div>
        <div class="bg-white p-6 rounded-lg shadow">
            <h2 class="text-lg font-semibold mb-4">Current Offer</h2>
            <div class="space-y-4">
                <div>
                    <div class="text-sm font-semibold">40% Discount Offer</div>
                    <div class="text-sm text-gray-500">Expire on: 05-08</div>
                    <div class="w-full bg-gray-200 rounded-full h-2.5 mt-2">
                        <div class="bg-green-500 h-2.5 rounded-full" style="width: 60%"></div>
                    </div>
                </div>
                <div>
                    <div class="text-sm font-semibold">100 Taka Coupon</div>
                    <div class="text-sm text-gray-500">Expire on: 10-09</div>
                    <div class="w-full bg-gray-200 rounded-full h-2.5 mt-2">
                        <div class="bg-gray-500 h-2.5 rounded-full" style="width: 100%"></div>
                    </div>
                </div>
                <div>
                    <div class="text-sm font-semibold">Stock Out Sell</div>
                    <div class="text-sm text-gray-500">Upcoming on: 14-09</div>
                    <div class="w-full bg-gray-200 rounded-full h-2.5 mt-2">
                        <div class="bg-teal-500 h-2.5 rounded-full" style="width: 20%"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    
@endif


