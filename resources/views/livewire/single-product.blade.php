@section('title', )

<div class="bg-blue-50 min-h-screen max-w-screen overflow-x-hidden overflow-y-auto">

    <div class="bg-white shadow-md rounded-lg p-6 max-w-[95vw] m-auto overflow-x-hidden">
        <div class="flex gap-8">
            <div class="flex-1 w-1/2">
                <div class="bg-gray-100 rounded-lg p-4 flex justify-center items-center">
                    <img src="{{asset('storage/' . $image)}}" alt="Image"
                        class="w-full h-auto max-h-[70vh] object-contain">
                </div>
            </div>

            <!-- Product Details -->
            <div class="flex-1 w-1/2">
                <h1 class="text-4xl font-bold mb-4">{{$product->name}} </h1>
                <p class="text-3xl font-semibold text-gray-800 mb-2">
                    ${{ number_format($product->base_price, 0) }}
                </p>

                <div class="p-4">
                    <!-- Color Selection -->
                    <div class="mb-6">
                        <label class="block text-gray-700 font-semibold mb-2">Select Color</label>
                        <div class="flex gap-2">
                            @foreach ($product['variants'] as $variantIndex => $variant)
                                <button wire:click="selectColor('{{ $variant['color']}}', {{$variantIndex}})" class="px-4 py-2 border rounded-lg text-gray-700 focus:outline-none
                                @if($selectedColor === $variant['color']) bg-gray-900 text-white @else bg-white @endif">
                                    {{ $variant['color'] }}
                                </button>
                            @endforeach
                        </div>
                    </div>

                    <!-- Size Selection -->
                    <div class="mb-6">
                        <label class="block text-gray-700 font-semibold mb-2">Select Size (UK)</label>
                        <div id="size-options" class="flex gap-2">

                            @php
                                $sizeMap = ['S' => 'Small', 'M' => 'Medium', 'L' => 'Large'];
                            @endphp
                            @foreach($sizeMap as $sizeValue => $size)
                                <button wire:click="selectSize('{{ $sizeValue }}')" class="px-4 py-2 border rounded-lg text-gray-700 focus:outline-none
                                   @if($selectedSize === $sizeValue) bg-gray-900 text-white @else bg-white @endif">
                                    {{ $size }}
                                </button>
                            @endforeach
                        </div>
                    </div>

                    <!-- Quantity Dropdown -->
                    <div class="mb-6">
                        <label for="quantity" class="block text-gray-700 font-semibold mb-2">Select Quantity</label>
                        <select wire:model="selectedQuantity" id="quantity"
                            class="w-full px-4 py-2 border rounded-lg text-gray-700 bg-white hover:bg-gray-100 focus:outline-none">
                            @for($i = 1; $i <= 5; $i++)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                    </div>

                    <!-- Message -->
                    @if(!empty($message))
                        <div class="{{ $messageColor }} p-3 mb-4 rounded shadow">
                            {{ htmlspecialchars($message) }}
                        </div>
                    @endif

                    <!-- Add to Cart Button -->
                    <button wire:click="addToCart"
                        class="w-full bg-black text-white py-3 rounded-lg text-center font-semibold mb-6 hover:bg-gray-800">
                        ADD TO CART
                    </button>
                </div>

                <p class="text-red-500 font-semibold">⚠ You must be logged in as our customer to maintain a cart.</p>
                <a href="SignIn.php" class="text-blue-500 underline">Log in here</a>

            </div>
        </div>
    </div>


</div>