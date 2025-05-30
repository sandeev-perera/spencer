<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Access Denied</title>
    
    <link rel="shortcut icon" href="{{ url('images/icons/logo.png') }}" type="image/x-icon">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link href="../assets/output.css" rel="stylesheet">
</head>
<body class="flex justify-center items-center min-h-screen bg-gradient-to-b from-red-600 to-gray-900">
<div class="p-8 rounded-lg shadow-lg w-full max-w-md text-center">
        <!-- Success Icon with Animated Effect -->
        <div class="relative flex justify-center">
            <img src="{{asset('images/icons/pacman.png')}}" class="h-20">
            <div class="absolute w-24 h-24 bg-orange-300 opacity-50 rounded-full animate-ping"></div>
        </div>

        <!-- Thank You Message -->
        <h2 class="text-2xl font-semibold mt-4">This Webpage is not for you</h2>

        <!-- Buttons -->
        <div class="mt-6 flex justify-center gap-4">
            <a href="{{route('show.index')}}" class="bg-gray-900 px-6 py-2 rounded-md text-white transition">Go back Home</a>
        </div>
    </div>
</body>
</html>