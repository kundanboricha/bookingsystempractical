<?php
namespace Database\Factories;

use App\Models\Booking;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookingFactory extends Factory
{
    protected $model = Booking::class;

    public function definition(): array
    {
        $type = $this->faker->randomElement(['full_day', 'half_day', 'custom']);
        $date = $this->faker->dateTimeBetween('-2 months', '+1 month')->format('Y-m-d');

        $booking = [
            'customer_name'  => $this->faker->name,
            'customer_email' => $this->faker->safeEmail,
            'booking_date'   => $date,
            'booking_type'   => $type,
        ];

        if ($type === 'half_day') {
            $booking['booking_slot'] = $this->faker->randomElement(['first_half', 'second_half']);
        }

        if ($type === 'custom') {
            $start = $this->faker->dateTimeBetween('09:00', '16:00')->format('H:i');
            $end   = \Carbon\Carbon::createFromFormat('H:i', $start)->addHours(1)->format('H:i');

            $booking['booking_from'] = $start;
            $booking['booking_to']   = $end;
        }

        return $booking;
    }
}
