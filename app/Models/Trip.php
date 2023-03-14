<?php

namespace App\Models;

use Database\Factories\TripFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

/**
 * @property int $source_station_id
 * @property-read Station $sourceStation
 * @property int $destination_station_id
 * @property-read Station $destinationStation
 * @property int $bus_id
 * @property-read Bus $bus
 * @property int $main_trip_id
 * @property-read Trip $mainTrip
 * @property-read Collection|Trip[] $subTrips
 */
class Trip extends Model
{
    use HasFactory;

    protected static function newFactory()
    {
        return TripFactory::new();
    }

    public function sourceStation(): BelongsTo
    {
        return $this->belongsTo(Station::class, 'source_station_id');
    }

    public function destinationStation(): BelongsTo
    {
        return $this->belongsTo(Station::class, 'destination_station_id');
    }

    public function mainTrip(): BelongsTo
    {
        return $this->belongsTo(static::class, 'parent_trip_id');
    }

    public function subTrips(): HasMany
    {
        return $this->hasMany(static::class, 'parent_trip_id');
    }

    public function bus(): BelongsTo
    {
        return $this->belongsTo(Bus::class, 'bus_id');
    }
}
