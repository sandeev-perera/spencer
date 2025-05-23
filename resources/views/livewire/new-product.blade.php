<div class="@if($show) block @else hidden @endif bg-white p-6 rounded-lg shadow">
    <h1 class="text-2xl font-semibold mb-6">Add New Product</h1>
    @if (session()->has('message'))
        <div class="mb-4 p-2 bg-green-100 text-green-700 rounded">
            {{ session('message') }}
        </div>
    @endif   
    <form wire:submit.prevent="save" class="space-y-6">
        <!-- Product ID -->
        <div>
            <label for="product_id" class="block text-sm font-medium text-gray-700">Product ID</label>
            <input type="number" id="product_id" wire:model="product_id" class=" w-1/5 mt-1 block border-gray-300 rounded-lg shadow-sm focus:border-teal-500 focus:ring-teal-500" required>
            @error('product_id')
                <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
            @enderror
        </div>

        <!-- Name -->
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
            <input type="text" id="name" wire:model="name" class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:border-teal-500 focus:ring-teal-500" required>
            @error('name')
                <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
            @enderror
        </div>

        <!-- Description -->
        <div>
            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
            <textarea id="description" wire:model="description" class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:border-teal-500 focus:ring-teal-500" rows="3"></textarea>
            @error('description')
                <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
            @enderror
        </div>

        <!-- Category -->
        <div>
            <label for="category" class="block text-sm font-medium text-gray-700">Category</label>
            <select id="category" wire:model="category" class="mt-1 block w-1/5 border-gray-300 rounded-lg shadow-sm focus:border-teal-500 focus:ring-teal-500" required>
                    <option value="Men">Men</option>
                    <option value="Women">Women</option>                  
                    <option value="Boys">Boys</option>                  
                    <option value="Girls">Girls</option>    
            </select>  
             @error('category')
                <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
            @enderror                   
        </div>

        <!-- Brand -->
        <div>
            <label for="brand" class="block text-sm font-medium text-gray-700">Brand</label>
            <select id="brand" wire:model.live="brand" class="mt-1 block w-1/5 border-gray-300 rounded-lg shadow-sm focus:border-teal-500 focus:ring-teal-500" required>
            @foreach ($availableBrands as $brand )
                    <option value="{{$brand}}">{{$brand}}</option>                  
                @endforeach
            </select>
            @error('brand')
                <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
            @enderror
        </div>

        <!-- Thumbnail Image -->
        <div>
            <label for="thumbnail_image" class="block text-sm font-medium text-gray-700">Thumbnail Image</label>
            <input type="file" id="thumbnail_image" wire:model="thumbnail_image" class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:border-teal-500 focus:ring-teal-500" required>
            @error('thumbnail_image')
                <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
            @enderror
        </div>

        <!-- Base Price -->
        <div>
            <label for="base_price" class="block text-sm font-medium text-gray-700">Base Price</label>
            <input type="number" id="base_price" wire:model="base_price" class="mt-1 block w-1/5 border-gray-300 rounded-lg shadow-sm focus:border-teal-500 focus:ring-teal-500" step="0.01" required>
             @error('base_price')
                <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
            @enderror
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700">Variants</label>
            @foreach($variants as $index => $variant)
                <div class="border border-gray-300 rounded-lg p-4 mb-4">
                    <!-- Color and Images on the same line -->
                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label for="color_{{ $index }}" class="block text-sm text-gray-700">Color</label>
                            <select id="color_{{ $index }}" wire:model="variants.{{ $index }}.color" class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:border-teal-500 focus:ring-teal-500" required>
                                <option value="">Select a color</option>
                                @foreach ($availableColors as $colorOption => $skuCode)
                                    <option value="{{ $skuCode }}">{{ $colorOption }}</option>
                                @endforeach
                            </select>
                            @error('variants.' . $index . '.color')
                                <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label for="images_{{ $index }}" class="block text-sm text-gray-700">Images</label>
                            <input type="file" id="images_{{ $index }}" wire:model="variants.{{ $index }}.images" multiple class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:border-teal-500 focus:ring-teal-500" required>
                            @error('variants.' . $index . '.images')
                                <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                            @enderror
                            @error('variants.' . $index . '.images.*')
                                <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Sub-Variants on new lines -->
                    @foreach($variant['sub_variants'] as $subIndex => $subVariant)
                        <div class="grid grid-cols-4 gap-4 mb-2 items-center">
                            <div>
                                <label for="size_{{ $index }}_{{ $subIndex }}" class="block text-sm text-gray-700">Size</label>
                                <input type="text" id="size_{{ $index }}_{{ $subIndex }}" wire:model="variants.{{ $index }}.sub_variants.{{ $subIndex }}.size" class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:border-teal-500 focus:ring-teal-500" required>
                                @error('variants.' . $index . '.sub_variants.' . $subIndex . '.size')
                                    <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                                @enderror
                            </div>
                            <div>
                                <label for="stock_quantity_{{ $index }}_{{ $subIndex }}" class="block text-sm text-gray-700">Stock Quantity</label>
                                <input type="number" id="stock_quantity_{{ $index }}_{{ $subIndex }}" wire:model="variants.{{ $index }}.sub_variants.{{ $subIndex }}.stock_quantity" class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:border-teal-500 focus:ring-teal-500" required>
                                @error('variants.' . $index . '.sub_variants.' . $subIndex . '.stock_quantity')
                                    <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <button type="button" wire:click="removeSubVariant({{ $index }}, {{ $subIndex }})" class="bg-red-500 text-white px-2 py-1 rounded-lg mt-6">Remove Sub Variant</button>
                            </div>
                        </div>
                    @endforeach

                    <div class="mt-2">
                        <button type="button" wire:click="addSubVariant({{ $index }})" class="bg-gray-900 text-white mt-2 px-2 py-2 rounded-lg">Add Sub Variant</button>
                    </div>

                    <!-- Remove Variant Button -->
                    <button type="button" wire:click="removeVariant({{ $index }})" class="mt-4 text-red-400">Remove Variant</button>
                </div>
            @endforeach

            <!-- Add Variant Button -->
            <button type="button" wire:click="addVariant" class="bg-teal-500 text-white px-4 py-2 rounded-lg">Add New Variant</button>
        </div>

        <!-- Tags -->
        <div>
            <label for="tags" class="block text-sm font-medium text-gray-700">Tags (comma-separated)</label>
            <input type="text" id="tags" wire:model="tags" class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:border-teal-500 focus:ring-teal-500" placeholder="e.g., new-arrival, top-seller">
            @error('tags')
                <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
            @enderror
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
