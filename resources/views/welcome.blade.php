<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Booking System</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .bg-booking {
            background-image: url('/sd.jpg');
            /* Replace with your actual image path */
            background-size: cover;
            background-position: center;
        }
    </style>
</head>

<body class="bg-booking text-gray-800 min-h-screen flex flex-col">

    <!-- Navigation Bar -->
    <nav class="w-full px-6 py-4 flex justify-between items-center bg-black bg-opacity-50 text-white fixed top-0 z-50">
        <div class="text-2xl font-bold">
            Booking System
        </div>
        <div class="flex gap-4">
            @auth
            <a href="{{ route('dashboard') }}" class="bg-blue-600 px-4 py-2 rounded hover:bg-blue-700 transition">
                Dashboard
            </a>
            @else
            <a href="{{ route('login') }}" class="bg-blue-500 px-4 py-2 rounded hover:bg-blue-600 transition">
                Login
            </a>
            <a href="{{ route('register') }}"
                class="bg-gray-200 text-gray-800 px-4 py-2 rounded hover:bg-gray-300 transition">
                Register
            </a>
            @endauth
        </div>
    </nav>

    <!-- Page Content -->
    <div style="margin-top: 20%" class="flex-grow flex items-center justify-center mt-20 px-4">
        <div class="max-w-lg w-full p-8 text-center text-white">
            <h1 id="animated-heading" class="text-5xl font-extrabold mb-4 min-h-[3.5rem]"></h1>
            <p class="text-lg mb-6 opacity-0 transition-opacity duration-1000 delay-500" id="animated-subtext">
                Easily book appointments or reserve services with ease.
            </p>
        </div>
    </div>

    <script>
        const heading = "Welcome to the Booking System";
    const words = heading.split(" ");
    const headingElement = document.getElementById("animated-heading");
    const subtextElement = document.getElementById("animated-subtext");

    let index = 0;

    function showNextWord() {
        if (index < words.length) {
            headingElement.innerHTML += (index === 0 ? "" : " ") + words[index];
            index++;
            setTimeout(showNextWord, 400); // Adjust timing here
        } else {
            subtextElement.classList.add("opacity-100");
        }
    }

    showNextWord();
    </script>


</body>

</html>
