<?php

namespace App\Models;

use Database\Factories\BusFactory;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property-read int $id
 * @property int $capacity
 * @property-read BusSeat[]|Collection  $seats
 */
class Bus extends Model
{
    use HasFactory;

    public static function newFactory()
    {
        return BusFactory::new();
    }

    public function seats(): HasMany
    {
        return $this->hasMany(BusSeat::class, 'bus_id');
    }
}
