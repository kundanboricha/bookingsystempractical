<x-app-layout>
    <div class="min-h-screen flex items-center justify-center bg-gray-100">
        <div class="bg-white shadow-md rounded-lg p-8 w-full max-w-xl">
            <h2 class="text-2xl font-bold mb-6 text-center text-gray-800">Booking Form</h2>

            {{-- Success Message --}}
            @if (session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
                {{ session('success') }}
            </div>
            @endif

            {{-- General Errors --}}
            @if ($errors->any())
            <div class="mb-4 p-4 bg-red-100 text-red-800 rounded">
                <ul class="list-disc list-inside text-sm">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form method="POST" action="{{ route('bookings.store') }}">
                @csrf

                {{-- Customer Name --}}
                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-1">Customer Name</label>
                    <input type="text" name="customer_name" value="{{ old('customer_name') }}"
                        class="w-full border @error('customer_name') border-red-500 @else border-gray-300 @enderror rounded px-3 py-2" />
                    @error('customer_name')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Customer Email --}}
                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-1">Customer Email</label>
                    <input type="email" name="customer_email" value="{{ old('customer_email') }}"
                        class="w-full border @error('customer_email') border-red-500 @else border-gray-300 @enderror rounded px-3 py-2" />
                    @error('customer_email')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Booking Date --}}
                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-1">Booking Date</label>
                    <input type="date" name="booking_date" value="{{ old('booking_date') }}"
                        class="w-full border @error('booking_date') border-red-500 @else border-gray-300 @enderror rounded px-3 py-2" />
                    @error('booking_date')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Booking Type --}}
                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-1">Booking Type</label>
                    <select name="booking_type" id="booking_type" onchange="toggleFields()"
                        class="w-full border @error('booking_type') border-red-500 @else border-gray-300 @enderror rounded px-3 py-2">
                        <option value="">Select</option>
                        <option value="full_day" {{ old('booking_type')=='full_day' ? 'selected' : '' }}>Full Day
                        </option>
                        <option value="half_day" {{ old('booking_type')=='half_day' ? 'selected' : '' }}>Half Day
                        </option>
                        <option value="custom" {{ old('booking_type')=='custom' ? 'selected' : '' }}>Custom</option>
                    </select>
                    @error('booking_type')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Booking Slot --}}
                <div id="slot_div" class="mb-4 {{ old('booking_type') == 'half_day' ? '' : 'hidden' }}">
                    <label class="block text-gray-700 font-semibold mb-1">Booking Slot</label>
                    <select name="booking_slot"
                        class="w-full border @error('booking_slot') border-red-500 @else border-gray-300 @enderror rounded px-3 py-2">
                        <option value="first_half" {{ old('booking_slot')=='first_half' ? 'selected' : '' }}>First Half
                        </option>
                        <option value="second_half" {{ old('booking_slot')=='second_half' ? 'selected' : '' }}>Second
                            Half</option>
                    </select>
                    @error('booking_slot')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Custom Times --}}
                <div id="time_div" class="mb-4 {{ old('booking_type') == 'custom' ? '' : 'hidden' }}">
                    <label class="block text-gray-700 font-semibold mb-1">Booking From</label>
                    <input type="time" name="booking_from" value="{{ old('booking_from') }}"
                        class="w-full border @error('booking_from') border-red-500 @else border-gray-300 @enderror rounded px-3 py-2" />
                    @error('booking_from')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror

                    <label class="block text-gray-700 font-semibold mt-4 mb-1">Booking To</label>
                    <input type="time" name="booking_to" value="{{ old('booking_to') }}"
                        class="w-full border @error('booking_to') border-red-500 @else border-gray-300 @enderror rounded px-3 py-2" />
                    @error('booking_to')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit"
                    class="w-full bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700 transition">
                    Book Now
                </button>
            </form>
        </div>
    </div>

    <script>
        function toggleFields() {
            const type = document.getElementById("booking_type").value;
            document.getElementById("slot_div").classList.toggle('hidden', type !== "half_day");
            document.getElementById("time_div").classList.toggle('hidden', type !== "custom");
        }

        // Trigger toggle on page load in case of validation error
        document.addEventListener("DOMContentLoaded", toggleFields);
    </script>
</x-app-layout>
