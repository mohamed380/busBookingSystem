<?php

namespace App\Services;

use App\Models\Station;
use App\Models\Trip;

class TripService
{
    public static function getTrip(Station $source, Station $destination): ?Trip
    {
        return Trip::where('source_station_id', $source->id)
            ->where('destination_station_id', $destination->id)
            ->first();
    }

}
