<?php

namespace App\Models;

use Database\Factories\ReservationFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $user_id
 * @property-read User $user
 * @property int $trip_id
 * @property-read Trip $trip
 * @property int $bus_seat_id
 * @property-read BusSeat $seat
 */
class Reservation extends Model
{
    use HasFactory;

    protected static function newFactory()
    {
        return ReservationFactory::new();
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function trip(): BelongsTo
    {
        return $this->belongsTo(Trip::class);
    }

    public function seat(): BelongsTo
    {
        return $this->belongsTo(BusSeat::class);
    }
}
