
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
                    <li class="mb-4">
                        <a wire:click="setSection('sales')" class="flex items-center {{ $selectedSection === 'sales' ? 'text-teal-500 font-semibold' : 'text-gray-600' }}" href="#">
                             <img src="{{ asset('images/icons/revenue.svg') }}" alt="Icon" class="w-10 h-10">
                            Sales
                        </a>
                    </li>
                    <li class="mb-4">
                        <a wire:click="setSection('customers')" class="flex items-center {{ $selectedSection === 'customers' ? 'text-teal-500 font-semibold' : 'text-gray-600' }}" href="#">
                             <img src="{{ asset('images/icons/customers.svg') }}" alt="Icon" class="w-10 h-10">
                            Customers
                        </a>
                    </li>
                    <li class="mb-4">
                        <a wire:click="setSection('settings')" class="flex items-center {{ $selectedSection === 'settings' ? 'text-teal-500 font-semibold' : 'text-gray-600' }}" href="#">
                             <img src="{{ asset('images/icons/settings.svg') }}" alt="Icon" class="w-10 h-10">
                            Settings
                        </a>
                    </li>
                </ul>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1 p-6 overflow-y-auto">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-sm font-semibold">admin@gmail.com</h1>
                <div class="flex items-center space-x-4">
                    <button class="border rounded-lg py-2 px-4 flex items-center">
                        30 May
                        <img src="{{ asset('images/icons/calender.svg') }}" alt="Icon" class="w-10 h-10">
                    </button>
                    <button class="border rounded-lg p-2">
                        [Placeholder]
                    </button>
                </div>
            </div>

            <!-- Dynamic Right Side Content -->
            {{-- <div class="grid grid-cols-2 gap-6">
                <livewire:overview :$selectedSection="$selectedSection" :show="$selectedSection === 'overview'" />
                <livewire:analytics :$selectedSection="$selectedSection" :show="$selectedSection === 'analytics'" />
                <livewire:products :$selectedSection="$selectedSection" :show="$selectedSection === 'products'" />
                <livewire:offers :$selectedSection="$selectedSection" :show="$selectedSection === 'offers'" />
                <livewire:inventory :$selectedSection="$selectedSection" :show="$selectedSection === 'inventory'" />
                <livewire:orders :$selectedSection="$selectedSection" :show="$selectedSection === 'orders'" />
                <livewire:sales :$selectedSection="$selectedSection" :show="$selectedSection === 'sales'" />
                <livewire:customer :$selectedSection="$selectedSection" :show="$selectedSection === 'customer'" />
                <livewire:newsletter :$selectedSection="$selectedSection" :show="$selectedSection === 'newsletter'" />
                <livewire:settings :$selectedSection="$selectedSection" :show="$selectedSection === 'settings'" />
            </div> --}}
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

                @case('customers')
                    <livewire:customers :selectedSection="$selectedSection" :show="true" />
                    @break
                @default
                    <div class="text-gray-500">Select a section to view content.</div>
            @endswitch
        </div>
    </div>
</div>
