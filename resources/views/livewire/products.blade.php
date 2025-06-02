@section('title', 'Spencer|'.ucfirst($category))
<div class="bg-gray-50 font-sans antialiased min-h-screen">
    <div class="flex flex-col lg:flex-row min-h-screen">
        <aside class="w-full lg:w-1/6 p-6 bg-white border-b lg:border-b-0 lg:border-r">
            <h2 class="font-bold text-lg mb-4">Brands</h2>
            
            @foreach($availableBrands as $brand)
                <div class="mb-2">
                    <label class="inline-flex items-center">
                        <!-- Use direct wire:model without .defer for immediate updates -->
                        <input type="checkbox" wire:model.live="selectedBrands" value="{{ $brand }}" class="form-checkbox text-indigo-600">
                        <span class="ml-2 text-gray-700">{{ $brand }}</span>
                    </label>
                </div>
            @endforeach
            
            <h2 class="font-bold text-lg mt-6 mb-4">Category</h2>
            @foreach($availableTags as $tag)
                <div class="mb-2">
                    <label class="inline-flex items-center">
                        <input type="checkbox" wire:model.live="selectedTags" value="{{ $tag }}" class="form-checkbox text-indigo-600">
                        <span class="ml-2 text-gray-700">{{ ucfirst($tag) }}</span>
                    </label>
                </div>
            @endforeach
        </aside>

        <!-- Product Grid -->
        <main class="flex-1 p-4 sm:p-6 overflow-y-auto">
            <h1 class="text-3xl sm:text-4xl font-bold text-center mb-8 sm:mb-12">Our ICONIC Collection</h1>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8 justify-items-center">
                
                @foreach ($products as $product)
                <a href="{{route('show.singleProduct', ['id' => $product->product_id])}}" 
                    class="bg-white shadow-lg rounded-lg overflow-hidden p-4 sm:p-6 cursor-pointer hover:shadow-xl hover:-translate-y-1 transition-transform duration-200 w-full max-w-sm flex flex-col justify-between animate-fade-up">

                    <!-- Product Image -->
                    <div class="w-full h-60 sm:h-72 flex justify-center items-center bg-gray-100">
                        <img src="{{asset('storage/'.$product->thumbnail_image)}}" 
                                alt="Product Image" class="w-full h-full object-contain">
                    </div>

                    <!-- Product Details -->
                    <div class="p-2 sm:p-4">
                        <h3 class="text-xl sm:text-2xl font-bold text-gray-900 mb-1 sm:mb-2">
                            {{ $product->name }}
                        </h3>
                        <div class="text-xl sm:text-2xl font-bold text-gray-800 mt-1 sm:mt-2">
                            ${{ number_format($product->base_price, 0) }}
                        </div>
                    </div>
                </a>                 
                @endforeach
            </div>
        </main>
    </div>
</div>




