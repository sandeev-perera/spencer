

<div class="bg-gray-100 font-sans">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="bg-white w-64 p-6 shadow-lg">
            <div class="text-xl font-bold mb-4 text-teal-500">Spencer Dashboard</div>
            <nav>
                <ul>
                    <li class="mb-4">
                        <a wire:click="setSection('overview')" class="flex items-center {{ $selectedSection === 'overview' ? 'text-teal-500 font-semibold' : 'text-gray-600' }}" href="#">
                             <img src="{{ asset('images/icons/overview.svg') }}" alt="Icon" class="w-10 h-10">
                            Dashboard
                        </a>
                    </li>
                    <li class="mb-4">
                        <a wire:click="setSection('Inventory')" class="flex items-center {{ $selectedSection === 'Inventory' ? 'text-teal-500 font-semibold' : 'text-gray-600' }}" href="#">
                             <img src="{{ asset('images/icons/inventory.svg') }}" alt="Icon" class="w-10 h-10">
                            View Inventory
                        </a>
                    </li>

                    <li class="mb-4">
                        <a wire:click="setSection('NewProduct')" class="flex items-center {{ $selectedSection === 'NewProduct' ? 'text-teal-500 font-semibold' : 'text-gray-600' }}" href="#">
                             <img src="{{ asset('images/icons/newProduct.svg') }}" alt="Icon" class="w-10 h-10">
                            Add New Product
                        </a>
                    </li>
                    <li class="mb-4">
                        <a wire:click="setSection('orders')" class="flex items-center {{ $selectedSection === 'orders' ? 'text-teal-500 font-semibold' : 'text-gray-600' }}" href="#">
                             <img src="{{ asset('images/icons/orders.svg') }}" alt="Icon" class="w-10 h-10">
                            Orders
                        </a>
                    </li>
                    
                </ul>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1 p-6 overflow-y-auto">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-sm font-semibold">{{Auth::user()->email}}</h1>
            </div>

            @switch($selectedSection)
                @case('overview')
                    <livewire:overview :selectedSection="$selectedSection" :show="true" />
                    @break
                @case('Inventory')
                    <livewire:inventory :selectedSection="$selectedSection" :show="true" />
                    @break               
                @case('NewProduct')
                    <livewire:NewProduct :selectedSection="$selectedSection" :show="true" />
                    @break
                
                @case('orders')
                    <livewire:orders :selectedSection="$selectedSection" :show="true" />
                    @break
                @default
                    <div class="text-gray-500">Select a section to view content.</div>
            @endswitch
        </div>
    </div>
</div>
