<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_name',
        'customer_email',
        'booking_date',
        'booking_type',
        'booking_slot',
        'booking_from',
        'booking_to',
    ];

    public static function getSlotTimeRange($slot)
    {
        return match ($slot) {
            'first_half' => ['09:00', '13:00'],
            'second_half' => ['14:00', '18:00'],
            default => [null, null],
        };
    }
}
