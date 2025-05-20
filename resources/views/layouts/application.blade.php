<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ url('images/icons/logo.png') }}" type="image/x-icon">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>@yield('title', 'Spencer')</title>
    @livewireStyles

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
</head>

<body class="max-w-screen overflow-x-hidden">
    @include('layouts.header') <!-- Make sure this header exists in the correct path -->
    
    <main>
        @yield('content')

        <!-- Slot will be rendered if a slot is passed to the layout -->
        @isset($slot)
            {{ $slot }}
        @endisset
    </main>
    
    <footer>
        @include('layouts.footer') <!-- Ensure this footer exists -->
    </footer>
    
    @livewireScripts <!-- Always load Livewire scripts just before closing </body> -->
</body>
</html>
