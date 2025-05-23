<div class="@if($show) block @else hidden @endif bg-white p-6 rounded-lg shadow">
    <div>
    <!-- Search Bar -->
    <div class="mb-4">
        <input type="text" wire:model.live.debounce.500ms="search" placeholder="Search by name / SKU / Brand..."
               class="w-full md:w-1/3 p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500">
    </div>

    @if (session()->has('message'))
        <div class="mb-4 p-2 bg-green-100 text-green-700 rounded">
            {{ session('message') }}
        </div>
    @endif   

    <div class="overflow-x-auto">
    <table class="min-w-full bg-white border border-gray-300 shadow-sm rounded-lg">
        <thead class="bg-gray-100 text-gray-600 uppercase text-sm">
            <tr>
                <th class="py-3 px-4 border-b">Product ID</th>
                <th class="py-3 px-4 border-b">Name</th>
                <th class="py-3 px-4 border-b">Category</th>
                <th class="py-3 px-4 border-b">Brand</th>
                <th class="py-3 px-4 border-b">Base Price</th>
                <th class="py-3 px-4 border-b">Total Stock</th>
                <th class="py-3 px-4 border-b">Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($products as $product)
                <!-- Product Row -->
                <tr class="hover:bg-gray-50 transition-colors border-b text-center">
                    <td class="py-3 px-4 font-medium">{{ $product->product_id }}</td>
                    <td class="py-3 px-4">{{ $product->name }}</td>
                    <td class="py-3 px-4">{{ $product->category }}</td>
                    <td class="py-3 px-4">{{ $product->brand }}</td>
                    <td class="py-3 px-4">Rs. {{ number_format($product->base_price, 2) }}</td>
                    <td class="py-3 px-4">
                        {{ collect($product->variants)->pluck('sub_variants')->flatten(1)->sum('stock_quantity') }}
                    </td>
                    <td class="bg-red-400 cursor-pointer" wire:click="editSection({{$product->product_id}})">Edit</td>
                </tr>

                <!-- Variant Rows -->
                @foreach ($product->variants as $variant)
                    @foreach ($variant['sub_variants'] as $sub)
                        <tr class="bg-gray-50 border-b text-center">
                            <td colspan="3" class="py-2 px-6 text-sm text-gray-700 text-right">🟦 Color: {{ $variant['color'] }}</td>
                            <td class="py-2 px-4 text-sm text-gray-700">Size: {{ $sub['size'] }}</td>
                            <td class="py-2 px-4 text-sm text-gray-700">Stock: {{ $sub['stock_quantity'] }}</td>
                            <td class="py-2 px-4 text-sm text-gray-700">SKU: {{ $sub['sku'] }}</td>
                        </tr>
                    @endforeach
                @endforeach
            @empty
                <tr>
                    <td colspan="6" class="py-6 text-center text-gray-500 italic">No products found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $products->links() }}
    </div> 
</div> 
@if ($showEditSection)
    <div class="mt-6 p-4 border rounded bg-white shadow">
        <h2 class="text-xl font-semibold mb-4">Edit Product</h2>

        <form wire:submit.prevent="updateProduct">

            <!-- Name -->
            <div class="mb-4">
                <label for="name" class="block font-medium mb-1">Name</label>
                <input type="text" id="name" wire:model.defer="editingProduct.name"
                    class="w-full border rounded px-3 py-2 border-gray-300 focus:border-teal-500 focus:ring-teal-500" readonly/>
                @error('editingProduct.name') <span class="text-red-600">{{ $message }}</span> @enderror
            </div>

            <!-- Description -->
            <div class="mb-4">
                <label for="description" class="block font-medium mb-1">Description</label>
                <textarea id="description" wire:model.defer="editingProduct.description"
                    class="w-full border rounded px-3 py-2 border-gray-300 focus:border-teal-500 focus:ring-teal-500" rows="3"></textarea>
                @error('editingProduct.description') <span class="text-red-600">{{ $message }}</span> @enderror
            </div>

            <!-- Base Price -->
            <div class="mb-4">
                <label for="base_price" class="block font-medium mb-1">Base Price</label>
                <input type="number" step="0.01" id="base_price" wire:model.defer="editingProduct.base_price"
                    class="w-full border rounded px-3 py-2 border-gray-300 focus:border-teal-500 focus:ring-teal-500" />
                @error('editingProduct.base_price') <span class="text-red-600">{{ $message }}</span> @enderror
            </div>

            <!-- Active Checkbox -->
            <div class="mb-6">
                <label class="inline-flex items-center">
                    <input type="checkbox" wire:model.defer="editingProduct.is_active" class="form-checkbox rounded border-gray-300 text-teal-500 focus:ring-teal-500" />
                    <span class="ml-2">Active</span>
                </label>
            </div>

            <!-- Variants and Sub-variants -->
            <div class="mb-6">
                <h3 class="font-semibold mb-2">Variants</h3>
                @foreach ($editingProduct['variants'] ?? [] as $vIndex => $variant)
                    <div class="mb-4 p-3 border rounded bg-gray-50">
                        <div class="mb-2">
                            <label class="block font-medium mb-1">Color</label>
                            <input type="text" wire:model.defer="editingProduct.variants.{{ $vIndex }}.color"
                                class="w-full border rounded px-3 py-2 border-gray-300 focus:border-teal-500 focus:ring-teal-500" readonly/>
                        </div>

                        <div class="ml-4">
                            <h4 class="font-medium mb-1">Sub-variants</h4>
                            @foreach ($variant['sub_variants'] as $sIndex => $sub)
                                <div class="mb-3 p-2 border rounded bg-white">
                                    <div class="mb-1">
                                        <label class="block font-medium">Size</label>
                                        <input type="text"
                                            wire:model.defer="editingProduct.variants.{{ $vIndex }}.sub_variants.{{ $sIndex }}.size"
                                            class="w-full border rounded px-3 py-2 border-gray-300 focus:border-teal-500 focus:ring-teal-500" readonly />
                                    </div>
                                    <div>
                                        <label class="block font-medium">Quantity</label>
                                        <input type="number"
                                            wire:model.defer="editingProduct.variants.{{ $vIndex }}.sub_variants.{{ $sIndex }}.stock_quantity"
                                            class="w-full border rounded px-3 py-2 border-gray-300 focus:border-teal-500 focus:ring-teal-500" min="0"  />
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>

            <button type="submit"
                class="bg-teal-500 hover:bg-gray-950 text-white font-semibold px-4 py-2 rounded">
                Save Changes
            </button>
            <button type="button" wire:click="cancalEdit"
                class="ml-2 px-4 py-2 border rounded hover:bg-gray-100">Cancel</button>
        </form>
    </div>
@endif
</div>