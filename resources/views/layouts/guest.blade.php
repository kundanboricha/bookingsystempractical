<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans text-gray-900 antialiased">
    <div class="flex min-h-screen bg-cover bg-center bg-no-repeat" style="background-color: rgb(117, 112, 112);">

        <!-- Left Side Text -->
        <div class="w-1/2 hidden lg:flex items-center justify-center text-white px-8">
            <div class="max-w-md text-left">
                <h1 class="text-5xl font-extrabold mb-4">Welcome to the Booking System</h1>
                <p class="text-lg">Register to easily book appointments and manage your bookings.</p>
            </div>
        </div>

        <!-- Right Side Slot for Form -->
        <div class="w-full lg:w-1/2 flex items-center justify-center bg-white bg-opacity-90 backdrop-blur-md p-8">
            <div class="w-full max-w-md">
                {{ $slot }}
            </div>
        </div>
    </div>
</body>

</html>
