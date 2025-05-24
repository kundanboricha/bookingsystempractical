<x-guest-layout>
    <!-- Page Title -->
    <div class="text-center mb-6">
        <h1 class="text-4xl font-bold text-gray-900">Log In</h1>
        <p class="text-gray-600 mt-2">Access your account</p>
    </div>

    <!-- Form Card -->
    {{-- <div class="bg-white shadow-md rounded-lg p-6"> --}}
        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}" class="space-y-4">
            @csrf

            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full bg-white text-black" type="email" name="email"
                    :value="old('email')" autofocus autocomplete="username" placeholder="Enter your email" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div>
                <x-input-label for="password" :value="__('Password')" />
                <x-text-input id="password" class="block mt-1 w-full bg-white text-black" type="password"
                    name="password" autocomplete="current-password" placeholder="Enter your password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Remember Me + Links -->
            <div class="flex items-center justify-between mt-4 flex-wrap gap-y-2">
                <!-- Remember Me on the left -->
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox"
                        class="rounded bg-white border-gray-300 text-indigo-600 shadow-sm focus:ring focus:ring-indigo-300"
                        name="remember">
                    <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>

                <!-- Links on the right -->
                <div class="text-sm font-medium text-black">
                    <a href="{{ route('password.request') }}" class="hover:underline">
                        {{ __('Forgot your password?') }}
                    </a><a href="{{ route('register') }}" class="hover:underline">
                        {{ __('Sign up') }}
                    </a>
                </div>
            </div>

            <!-- Login Button -->
            <div class="flex justify-end mt-4">
                <button type="submit"
                    class="bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded focus:outline-none focus:ring focus:ring-green-300">
                    {{ __('Log in') }}
                </button>
            </div>


        </form>
        {{--
    </div> --}}
</x-guest-layout>
