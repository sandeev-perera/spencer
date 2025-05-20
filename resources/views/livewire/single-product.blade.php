@section('title', 'Single Product')

<div class="bg-blue-50 min-h-screen max-w-screen overflow-x-hidden overflow-y-auto">

    <div class="bg-white shadow-md rounded-lg p-6 max-w-[95vw] m-auto overflow-x-hidden">
        <div class="flex gap-8">
            <div class="flex-1 w-1/2">
                <div class="bg-gray-100 rounded-lg p-4 flex justify-center items-center">
                    <img src="https://static.nike.com/a/images/t_PDP_936_v1/f_auto,q_auto:eco/30d7afaa-343b-4439-b65d-bb544c65420e/NIKE+REVOLUTION+7.png" alt="Image"
                        class="w-full h-auto max-h-[70vh] object-contain">
                </div>
            </div>

            <!-- Product Details -->
            <div class="flex-1 w-1/2">
                <h1 class="text-4xl font-bold mb-4">{{$product->name}} </h1>
                <p class="text-3xl font-semibold text-gray-800 mb-2">
                    ${{ number_format($product->base_price, 0) }}
                </p>

                <!-- Only show the "Select Size" option and "Add to Cart" button if the user is logged in -->
                <!-- Add to Cart Form -->
                <form action="" method="POST" onsubmit="return validateForm()">
                    <div class="mb-6 mt-16">
                        <label class="block text-gray-700 font-semibold mb-2">Select size (UK)</label>
                        <div id="size-options" class="flex gap-2">
                            <button type="button" value="Small"
                                class="size-btn px-4 py-2 border rounded-lg text-gray-700 hover:bg-gray-100 focus:bg-gray-900 focus:text-white">
                                Small
                            </button>
                            <button type="button" value="Medium"
                                class="size-btn px-4 py-2 border rounded-lg text-gray-700 hover:bg-gray-100 focus:bg-gray-900 focus:text-white">
                                Medium
                            </button>
                            <button type="button" value="Large"
                                class="size-btn px-4 py-2 border rounded-lg text-gray-700 hover:bg-gray-100 focus:bg-gray-900 focus:text-white">
                                Large
                            </button>
                        </div>
                        <input type="hidden" id="selected-size" name="size" />
                        <p id="size-error" class="text-red-500 font-semibold mt-2 hidden">⚠ Please select a size!</p>
                    </div>

                    <!-- Quantity Dropdown -->
                    <div class="mb-6">
                        <label for="quantity" class="block text-gray-700 font-semibold mb-2">Select Quantity</label>
                        <select id="quantity" name="quantity" required
                            class="w-full px-4 py-2 border rounded-lg text-gray-700 bg-white hover:bg-gray-100 focus:outline-none">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                    </div>

                    <!-- Hidden Inputs for Product Data -->
                    <input type="hidden" name="ProductID"
                        value="">
                    <input type="hidden" name="ProductName" value="">
                    <input type="hidden" name="ProductColor" value="">

                    <!-- Message -->
                    <?php if (!empty($message)): ?>
                    <div class="<?php echo $messageColor; ?> p-3 mb-4 rounded shadow">
                        <?php echo htmlspecialchars($message); ?>
                    </div>
                    <?php endif; ?>


                    <!-- Add to Cart Button -->
                    <button type="submit"
                        class="w-full bg-black text-white py-3 rounded-lg text-center font-semibold mb-6 hover:bg-gray-800">
                        ADD TO CART
                    </button>
                </form>

                <p class="text-red-500 font-semibold">⚠ You must be logged in as our customer to maintain a cart.</p>
                <a href="SignIn.php" class="text-blue-500 underline">Log in here</a>

            </div>
        </div>
    </div>
    

</div>

