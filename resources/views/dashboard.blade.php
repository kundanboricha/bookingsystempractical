<x-app-layout>
    <div class="max-w-2xl mx-auto mt-10">
        <div class="bg-white shadow-md rounded px-8 py-6">
            <h2 class="text-2xl font-bold mb-6 text-gray-800">Booking Form</h2>

            @if(session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
                {{ session('success') }}
            </div>
            @endif

            @if($errors->any())
            <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
                <ul class="list-disc pl-5">
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form method="POST" action="{{ route('bookings.store') }}">
                @csrf

                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-1">Customer Name</label>
                    <input type="text" name="customer_name" required placeholder="Enter your full name"
                        class="w-full border border-gray-300 rounded px-3 py-2" />
                </div>

                <div class=" mb-4">
                    <label class="block text-gray-700 font-semibold mb-1">Customer Email</label>
                    <input type="email" name="customer_email" class="w-full border border-gray-300 rounded px-3 py-2" />
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-1">Booking Date</label>
                    <input type="date" name="booking_date" class="w-full border border-gray-300 rounded px-3 py-2" />
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-1">Booking Type</label>
                    <select name="booking_type" id="booking_type" onchange="toggleFields()"
                        class="w-full border border-gray-300 rounded px-3 py-2">
                        <option value="">Select</option>
                        <option value="full_day">Full Day</option>
                        <option value="half_day">Half Day</option>
                        <option value="custom">Custom</option>
                    </select>
                </div>

                <div id="slot_div" class="mb-4" style="display:none;">
                    <label class="block text-gray-700 font-semibold mb-1">Booking Slot</label>
                    <select name="booking_slot" class="w-full border border-gray-300 rounded px-3 py-2">
                        <option value="first_half">First Half</option>
                        <option value="second_half">Second Half</option>
                    </select>
                </div>

                <div id="time_div" class="mb-4" style="display:none;">
                    <label class="block text-gray-700 font-semibold mb-1">Booking From</label>
                    <input type="time" name="booking_from" class="w-full border border-gray-300 rounded px-3 py-2" />

                    <label class="block text-gray-700 font-semibold mb-1 mt-4">Booking To</label>
                    <input type="time" name="booking_to" class="w-full border border-gray-300 rounded px-3 py-2" />
                </div>

                <div>
                    <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
                        Book Now
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function toggleFields() {
            const type = document.getElementById("booking_type").value;
            document.getElementById("slot_div").style.display = type === "half_day" ? "block" : "none";
            document.getElementById("time_div").style.display = type === "custom" ? "block" : "none";
        }
    </script>
</x-app-layout>