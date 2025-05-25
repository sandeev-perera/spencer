
<body class="overflow-y-auto">
    <header class="text-white" style="background-color: rgb(206,2,29);">
        <div class="container mx-auto flex items-center justify-between py-4 px-4 h-[10vh]">
            <!-- Left Section: Logo -->
            <div class="flex-shrink-0">
                <a href="{{route('show.index')}}">
                    <img src="{{url('images/icons/logo.png')}}" class="h-24">
                </a>
            </div>

            <!-- Middle Section: Links (Desktop) -->
            <nav class="hidden md:flex space-x-8 text-lg">
                <a href="{{route('products', ['category' => 'men']) }}" class="hover:text-black font-bold">Men</a>
                <a href="{{ route('products', ['category' => 'women']) }}" class="hover:text-black font-bold">Women</a>
                <a href="{{route('products', ['category' => 'boys']) }}" class="hover:text-black font-bold">Boys</a>
                <a href="{{route('products', ['category' => 'girls']) }}" class="hover:text-black font-bold">Girls</a>
            </nav>

            <!-- Mobile Menu Button (Hamburger Icon) -->
            <button id="menu-button" class="md:hidden focus:outline-none">
                <img src="{{url('images/icons/hamburger.png')}}" class="h-8 w-8">
            </button>

            <!-- Mobile Dropdown Menu -->
            <div id="mobile-menu" class="hidden absolute top-[10vh] left-0 w-full bg-white shadow-lg md:hidden z-50 text-center">
                <a href="{{route('products', ['category' => 'men']) }}" class="block px-4 py-2 text-gray-800 ">Men</a>
                <a href="{{route('products', ['category' => 'women']) }}" class="block px-4 py-2 text-gray-800">Women</a>
                <a href="{{route('products', ['category' => 'boys']) }}" class="block px-4 py-2 text-gray-800">Boys</a>
                <a href="{{route('products', ['category' => 'girls']) }}" class="block px-4 py-2 text-gray-800">Girls</a>
            </div>

            <!-- Right Section: Cart and Profile Icons -->
            <div class="flex items-center space-x-6 justify-center">
                <!-- Cart Icon -->
                @if(Auth::check() && Auth::user()->role === "customer")
                 <a href="{{route('show.Cart')}}" class="relative hover:text-gray-400">
                    <img src="{{url('images/icons/cartIcon.png')}}" class="h-6 w-6">
                </a>
                @endif
                <!-- Profile Icon -->
                <div class="relative">
                    <button onclick="toggleDropdown()" class="focus:outline-none">
                        <img src="{{url('images/icons/icons8-male-user-64.png')}}" class="h-6 w-6">
                    </button>
                    <!-- Dropdown Menu -->
                    <?php if(Auth::check()): ?>
    <div id="profile-dropdown" class="hidden absolute right-0 mt-2 w-40 bg-white shadow-lg z-50">
        <!-- Link to profile edit page -->
        <a href="<?= route('profile.edit') ?>" class="block px-4 py-2 text-gray-800 hover:bg-gray-100">
            My Profile
        </a>

        <!-- Logout form -->
        <form method="POST" action="<?= route('logout') ?>">
            <?= csrf_field() ?>
            <button type="submit" class="block w-full text-left px-4 py-2 text-gray-800 hover:bg-gray-100">
                Logout
            </button>
        </form>
    </div>
<?php else: ?>
    <div id="profile-dropdown" class="hidden absolute right-0 mt-2 w-40 bg-white shadow-lg z-50">
        <button onclick="window.location.href='<?= route('login') ?>';" class="block w-full text-left px-4 py-2 text-gray-800 hover:bg-gray-100">
            Log In
        </button>
    </div>
<?php endif; ?>

                </div>
            </div>
        </div>
    </header>

    <!-- JavaScript for Menu & Dropdown -->
    <script>
        // Toggle Profile Dropdown
        function toggleDropdown() {
            const dropdown = document.getElementById('profile-dropdown');
            dropdown.classList.toggle('hidden');
        }

        // Confirm Logout
        

        // Close the dropdown when clicking outside
        document.addEventListener('click', function(event) {
            const dropdown = document.getElementById('profile-dropdown');
            const button = dropdown.previousElementSibling;
            if (!button.contains(event.target) && !dropdown.contains(event.target)) {
                dropdown.classList.add('hidden');
            }
        });

        // Toggle Mobile Menu
        document.getElementById('menu-button').addEventListener('click', function() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        });

        // Close the menu when clicking outside
        document.addEventListener('click', function(event) {
            const menu = document.getElementById('mobile-menu');
            const button = document.getElementById('menu-button');
            if (!button.contains(event.target) && !menu.contains(event.target)) {
                menu.classList.add('hidden');
            }
        });
    </script>
</body>
