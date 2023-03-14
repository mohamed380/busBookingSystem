<?php

namespace App\Models;

use Database\Factories\TripFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $source_station_id
 * @property-read Station $sourceStation
 * @property int $destination_station_id
 * @property-read Station $destinationStation
 * @property int $bus_id
 * @property-read Bus $bus
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

    public function bus(): BelongsTo
    {
        return $this->belongsTo(Bus::class, 'bus_id');
    }
}
