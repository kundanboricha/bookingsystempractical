<?php
namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BookingController extends Controller
{
    // Show the booking form
    public function index()
    {
        return view('booking.booking');
    }

    // Handle booking form submission
    public function store(Request $request)
    {
        // Step 1: Validate input
        $validator = Validator::make($request->all(), [
            'customer_name'  => 'required|string|max:255',
            'customer_email' => 'required|email|max:255',
            'booking_date'   => 'required|date',
            'booking_type'   => 'required|in:full_day,half_day,custom',
            'booking_slot'   => 'nullable|in:first_half,second_half',
            'booking_from'   => 'nullable|date_format:H:i',
            'booking_to'     => 'nullable|date_format:H:i|after:booking_from',
        ]);

        if ($validator->fails()) {
            // Redirect back with validation errors
            return back()->withErrors($validator)->withInput();
        }

        // Step 2: Prepare input data
        $bookingDate = $request->booking_date;
        $type        = $request->booking_type;
        $from        = $request->booking_from;
        $to          = $request->booking_to;
        $slot        = $request->booking_slot;

        // Step 3: Fetch existing bookings for the same date
        $existingBookings = Booking::where('booking_date', $bookingDate)->get();

        // Step 4: Loop through existing bookings to check for overlap
        foreach ($existingBookings as $existing) {
            // Full Day: no other booking allowed on same date
            if ($type === 'full_day') {
                return back()->withErrors(['booking_date' => 'Date already fully booked']);
            }

            // Half Day: Check for overlap with full day, same slot, or custom
            if ($type === 'half_day') {
                if ($existing->booking_type === 'full_day') {
                    return back()->withErrors(['booking_slot' => 'Slot overlaps with full day booking']);
                }

                if ($existing->booking_type === 'half_day' && $existing->booking_slot === $slot) {
                    return back()->withErrors(['booking_slot' => 'Slot already booked']);
                }

                if ($existing->booking_type === 'custom' && $this->timesOverlap($slot, $existing)) {
                    return back()->withErrors(['booking_slot' => 'Slot overlaps with a custom booking']);
                }
            }

            // Custom Time: Check for overlap with full day, half day slot, or another custom range
            if ($type === 'custom') {
                if ($existing->booking_type === 'full_day') {
                    return back()->withErrors(['booking_from' => 'Time overlaps with full day booking']);
                }

                if ($existing->booking_type === 'half_day' && $this->slotTimeOverlap($from, $to, $existing->booking_slot)) {
                    return back()->withErrors(['booking_from' => 'Time overlaps with half day booking']);
                }

                if ($existing->booking_type === 'custom' &&
                    ! ($to <= $existing->booking_from || $from >= $existing->booking_to)) {
                    return back()->withErrors(['booking_from' => 'Custom time overlaps']);
                }
            }
        }

        // Step 5: No overlaps found, create new booking
        Booking::create([
            'customer_name'  => $request->customer_name,
            'customer_email' => $request->customer_email,
            'booking_date'   => $bookingDate,
            'booking_type'   => $type,
            'booking_slot'   => $slot,
            'booking_from'   => $from,
            'booking_to'     => $to,
        ]);

        return redirect()->back()->with('success', 'Booking successful!');
    }

    /**
     * Check overlap of half day slot with custom booking.
     *
     * @param string $slot     Requested half-day slot
     * @param object $existing Existing booking record (type = custom)
     * @return bool
     */
    private function timesOverlap($slot, $existing)
    {
        [$slotStart, $slotEnd] = Booking::getSlotTimeRange($slot);
        return ! ($slotEnd <= $existing->booking_from || $slotStart >= $existing->booking_to);
    }

    /**
     * Check overlap of custom time with existing half-day slot.
     *
     * @param string $from     Custom booking start time
     * @param string $to       Custom booking end time
     * @param string $slot     Existing half-day slot
     * @return bool
     */
    private function slotTimeOverlap($from, $to, $slot)
    {
        [$slotStart, $slotEnd] = Booking::getSlotTimeRange($slot);
        return ! ($to <= $slotStart || $from >= $slotEnd);
    }
}
