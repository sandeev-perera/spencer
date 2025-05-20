<!DOCTYPE html>
<html lang="en">
<link href="../assets/output.css" rel="stylesheet">
@vite(['resources/css/app.css', 'resources/js/app.js'])


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <footer class="bg-black text-white py-10">
        <div class="container mx-auto px-6 lg:px-20">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Company Info -->
                <div>
                    <h2 class="text-2xl font-bold">SPENCER</h2>
                    <p class="text-gray-400 mt-2">Elevate your game with the freshest sneakers and high-performance
                        footwear!</p>
                </div>

                <!-- Quick Links -->
                <div>
                    <h3 class="text-lg font-semibold mb-3">Quick Links</h3>
                    <ul class="space-y-2">
                        <li><a href="{{url('/')}}">HOME</a></li>
                        <li><a href="{{route('products', ['category' => 'men']) }}" class="hover:text-gray-300 transition">MEN</a>
                        </li>
                        <li><a href="{{route('products', ['category' => 'women']) }}"
                                class="hover:text-gray-300 transition">WOMEN</a></li>
                        <li><a href="{{route('products', ['category' => 'boys']) }}"
                                class="hover:text-gray-300 transition">BOYS</a></li>
                        <li><a href="{{route('products', ['category' => 'girls']) }}"
                                class="hover:text-gray-300 transition">GIRLS</a></li>
                    </ul>
                </div>

                <!-- Social Media -->
                <div>
                    <h3 class="text-lg font-semibold mb-3">Follow Us</h3>
                    <div class="flex space-x-4">
                        <a href="https://www.facebook.com">
                            <img src="{{url('images/icons/facebook.png')}}" alt="Facebook" class="h-6 w-6 mr-4">
                        </a>
                        <a href="#">
                            <img src="{{url('images/icons/twitter.png')}}" alt="Twitter" class="h-6 w-6 mr-4">
                        </a>
                        <a href="https://www.instergram.com">
                            <img src="{{url('images/icons/instagram.png')}}" alt="Instagram" class="h-6 w-6 mr-4">
                        </a>
                        <a href="https://www.youtube.com/watch?v=dQw4w9WgXcQ">
                            <img src="{{url('images/icons/youtube.png')}}" alt="YouTube" class="h-6 w-6 mr-4">
                        </a>
                    </div>
                </div>
            </div>

            <!-- Copyright -->
            <div class="border-t border-gray-700 mt-8 pt-4 text-center text-gray-400 text-sm">
                &copy; 2025 Spencer. All rights reserved.
            </div>
        </div>
    </footer>
</body>

</html>