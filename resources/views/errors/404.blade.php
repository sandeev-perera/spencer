<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Page Not Found</title>
    <link rel="shortcut icon" href="{{ url('images/icons/logo.png') }}" type="image/x-icon">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="flex items-center justify-center min-h-screen bg-gradient-to-b from-red-600 to-gray-900 text-white font-sans">

    <div class="text-center px-6">
        <!-- Animated Ping with 404 Image -->
        <div class="relative flex items-center justify-center w-40 h-40 mx-auto">
            <div class="absolute w-32 h-32 bg-orange-400 opacity-50 rounded-full animate-ping z-0"></div>
            <img src="{{ url('images/icons/404.png') }}" alt="404" class="relative z-10 w-28 h-28">
        </div>

        <!-- Message -->
        <h1 class="text-4xl font-bold mt-6">Oops! Page Not Found</h1>
        <p class="text-lg mt-2 text-gray-200">The page you're looking for doesn't exist.</p>

        <!-- Button -->
        <a href="{{ url('/') }}" class="mt-6 inline-block px-6 py-3 bg-gray-900 rounded-md hover:bg-red-700 transition duration-300">
            Go Back Home
        </a>
    </div>

</body>
</html>
