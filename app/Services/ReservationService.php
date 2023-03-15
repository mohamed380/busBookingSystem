<?php

namespace App\Services;

use App\Models\Trip;
use App\Models\User;
use Illuminate\Support\Collection;

class ReservationService
{
    public static function getAvailableSeats(Trip $trip)
    {
        $mainTrip = $trip->isMainTrip() ? $trip : $trip->mainTrip;

        if ($mainTrip->bus->capacity == $mainTrip->reservations()->count()) {

            return collect();

        }

        $leavedSeats = $mainTrip->subTrips()
            ->where('destination_station_id', $trip->source_station_id)
            ->with('reservations')
            ->get()->pluck('reservations')->collapse();

        $bookedSeats = $mainTrip->subTrips()
            ->where('source_station_id', $trip->source_station_id)
            ->with('reservations')
            ->get()->pluck('reservations')->collapse();

        if($leavedSeats->count() <= $bookedSeats->count())
            return collect();


        $availableSeats = $leavedSeats->diff($bookedSeats);
    }

    public function tripsTrack()
    {
        $stationsCapacity = [];
        $stationsReservation = [];
        $stationsLeftReservations = [];


        $trips = Trip::with('reservations')->get();

        $groupedBySource = $trips->groupBy('source_station_id');
        $groupedByDestination = $trips->groupBy('destination_station_id');

        $groupedBySource->each(function(Collection $sourceTripsGroup, int $sourceStationId) use (&$stationsReservation){
            $stationsReservation[$sourceStationId] = $sourceTripsGroup->pluck('reservations')->collapse();
        });

        $groupedByDestination->each(function(Collection $destinationTripsGroup, int $destinationStationId) use (&$stationsLeftReservations){
            $stationsLeftReservations[$destinationStationId] = $destinationTripsGroup->pluck('reservations')->collapse();
        });

        $c = 0;
        foreach ($stationsReservation as $stationId => $reservations){

            if($c == 0){
                $stationsCapacity[$stationId] = $reservations->count();
            }else{
                $stationLeftSeats = count(($stationsLeftReservations[$stationId]));
                $stationsCapacity[$stationId] = ($reservations->count() + last($stationsCapacity)) - $stationLeftSeats;
            }

            $c++;
        }

        return $stationsCapacity;

    }
}
