<div class="@if($show) block @else hidden @endif bg-white p-6 rounded-lg shadow">
    <h1 class="text-2xl font-semibold mb-6">Add New Product</h1>

    <form wire:submit.prevent="save" class="space-y-6">
        <!-- Product ID -->
        <div>
            <label for="product_id" class="block text-sm font-medium text-gray-700">Product ID</label>
            <input type="number" id="product_id" wire:model="product_id" class=" w-1/5 mt-1 block border-gray-300 rounded-lg shadow-sm focus:border-teal-500 focus:ring-teal-500">
        </div>

        <!-- Name -->
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
            <input type="text" id="name" wire:model="name" class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:border-teal-500 focus:ring-teal-500">
        </div>

        <!-- Description -->
        <div>
            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
            <textarea id="description" wire:model="description" class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:border-teal-500 focus:ring-teal-500" rows="3"></textarea>
        </div>

        <!-- Category -->
        <div>
            <label for="category" class="block text-sm font-medium text-gray-700">Category</label>
            <select id="category" wire:model="category" class="mt-1 block w-1/5 border-gray-300 rounded-lg shadow-sm focus:border-teal-500 focus:ring-teal-500">
                    <option value="Men">Men</option>
                    <option value="Women">Women</option>                  
                    <option value="Boys">Boys</option>                  
                    <option value="Girls">Girls</option>    
            </select>                     
        </div>

        <!-- Brand -->
        <div>
            <label for="brand" class="block text-sm font-medium text-gray-700">Brand</label>
            <select id="brand" wire:model.live="brand" class="mt-1 block w-1/5 border-gray-300 rounded-lg shadow-sm focus:border-teal-500 focus:ring-teal-500">
            @foreach ($availableBrands as $brand )
                    <option value="{{$brand}}">{{$brand}}</option>                  
                @endforeach
            </select>
        </div>

        <!-- Thumbnail Image -->
        <div>
            <label for="thumbnail_image" class="block text-sm font-medium text-gray-700">Image</label>
            <input type="file" id="thumbnail_image" wire:model="thumbnail_image" class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:border-teal-500 focus:ring-teal-500">
        </div>

        <!-- Base Price -->
        <div>
            <label for="base_price" class="block text-sm font-medium text-gray-700">Base Price</label>
            <input type="number" id="base_price" wire:model="base_price" class="mt-1 block w-1/5 border-gray-300 rounded-lg shadow-sm focus:border-teal-500 focus:ring-teal-500" step="0.01">
        </div>

        <!-- Variants -->
        <div>
            <label class="block text-sm font-medium text-gray-700">Variants</label>
            @foreach($variants as $index => $variant)
                <div class="border border-gray-300 rounded-lg p-4 mb-4">
                    <div class="grid grid-cols-5 gap-4">
                        <div>
                            <label for="color_{{ $index }}" class="block text-sm text-gray-700">Color</label>
                            <input type="text" id="color_{{ $index }}" wire:model="variants.{{ $index }}.color" class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:border-teal-500 focus:ring-teal-500">
                        </div>
                        <div>
                            <label for="size_{{ $index }}" class="block text-sm text-gray-700">Size</label>
                            <input type="text" id="size_{{ $index }}" wire:model="variants.{{ $index }}.size" class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:border-teal-500 focus:ring-teal-500">
                        </div>
                        <div>
                            <label for="stock_quantity_{{ $index }}" class="block text-sm text-gray-700">Stock Quantity</label>
                            <input type="number" id="stock_quantity_{{ $index }}" wire:model="variants.{{ $index }}.stock_quantity" class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:border-teal-500 focus:ring-teal-500">
                        </div>
                        <div>
                            <label for="sku_{{ $index }}" class="block text-sm text-gray-700">SKU</label>
                            <input type="text" id="sku_{{ $index }}" wire:model="variants.{{ $index }}.sku" class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:border-teal-500 focus:ring-teal-500">
                        </div>
                        <div>
                            <label for="images_{{ $index }}" class="block text-sm text-gray-700">Images</label>
                            <input type="file" id="images_{{ $index }}" wire:model="variants.{{ $index }}.images" multiple class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:border-teal-500 focus:ring-teal-500">
                        </div>
                    </div>
                    <button type="button" wire:click="removeVariant({{ $index }})" class="mt-2 text-red-400">Remove Variant</button>
                </div>
            @endforeach
            <button type="button" wire:click="addVariant" class="bg-teal-500 text-white px-4 py-2 rounded-lg">Add Variant</button>
        </div>

        <!-- Tags -->
        <div>
            <label for="tags" class="block text-sm font-medium text-gray-700">Tags (comma-separated)</label>
            <input type="text" id="tags" wire:model="tags" class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:border-teal-500 focus:ring-teal-500" placeholder="e.g., new-arrival, top-seller">
        </div>

        <!-- Is Active -->
        <div>
            <label class="inline-flex items-center">
                <input type="checkbox" wire:model="is_active" class="rounded border-gray-300 text-teal-500 focus:ring-teal-500">
                <span class="ml-2 text-sm text-gray-700">Is Active</span>
            </label>
        </div>

        <!-- Submit Button -->
        <div>
            <button type="submit" class="bg-teal-500 text-white px-4 py-2 rounded-lg">Save Product</button>
        </div>
    </form>
</div>
