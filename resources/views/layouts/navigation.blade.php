<nav x-data="{ open: false }"
    class="w-full px-6 py-4 flex justify-between items-center bg-black bg-opacity-50 text-white fixed top-0 z-50">
    <!-- Logo / Title -->
    <div class="text-2xl font-bold">
        Booking System
    </div>

    <!-- Desktop Links -->
    <div class="hidden sm:flex gap-4 items-center">
        @auth
        {{-- <a href="{{ route('dashboard') }}" class="bg-blue-600 px-4 py-2 rounded hover:bg-blue-700 transition">
            Dashboard
        </a> --}}

        <!-- Avatar + Dropdown -->
        <x-dropdown align="right" width="48">
            <x-slot name="trigger">
                <button
                    class="inline-flex items-center px-3 py-2 text-sm font-medium rounded-md text-white bg-transparent hover:text-gray-200 transition">
                    <div
                        class="h-8 w-8 flex items-center justify-center rounded-full bg-white text-black font-bold uppercase">
                        {{ strtoupper(optional(Auth::user())->first_name[0] ?? '?') }}
                    </div>
                    <span class="ml-2">{{ Auth::user()->name }}</span>
                    <svg class="ml-1 h-4 w-4 fill-current" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                            clip-rule="evenodd" />
                    </svg>
                </button>
            </x-slot>

            <x-slot name="content">
                <x-dropdown-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-dropdown-link>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-dropdown-link :href="route('logout')"
                        onclick="event.preventDefault(); this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-dropdown-link>
                </form>
            </x-slot>
        </x-dropdown>

        @else
        <a href="{{ route('login') }}" class="bg-blue-500 px-4 py-2 rounded hover:bg-blue-600 transition">
            Login
        </a>
        <a href="{{ route('register') }}" class="bg-gray-200 text-black px-4 py-2 rounded hover:bg-gray-300 transition">
            Register
        </a>
        @endauth
    </div>

    <!-- Hamburger -->
    <div class="sm:hidden">
        <button @click="open = ! open"
            class="inline-flex items-center justify-center p-2 rounded-md text-white hover:bg-gray-700 focus:outline-none">
            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex" stroke-linecap="round"
                    stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                    stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>

    <!-- Mobile Menu -->
    <div :class="{ 'block': open, 'hidden': !open }" class="sm:hidden mt-4 w-full">
        <div class="flex flex-col space-y-2">
            @auth
            <a href="{{ route('dashboard') }}"
                class="bg-blue-600 px-4 py-2 rounded hover:bg-blue-700 transition text-white">
                Dashboard
            </a>
            <a href="{{ route('profile.edit') }}"
                class="bg-gray-200 text-black px-4 py-2 rounded hover:bg-gray-300 transition">
                Profile
            </a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 transition w-full text-left">
                    Log Out
                </button>
            </form>
            @else
            <a href="{{ route('login') }}"
                class="bg-blue-500 px-4 py-2 rounded hover:bg-blue-600 transition text-white">
                Login
            </a>
            <a href="{{ route('register') }}"
                class="bg-gray-200 text-black px-4 py-2 rounded hover:bg-gray-300 transition">
                Register
            </a>
            @endauth
        </div>
    </div>
</nav>