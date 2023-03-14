<?php

namespace App\Models;

use Database\Factories\StationFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property string $name
 * @property int|null $next_station_id
 * @property-read Station|null $nextStation
 * @property int|null $previous_station_id
 * @property-read Station|null $previousStation
 */
class Station extends Model
{
    use HasFactory;

    protected static function newFactory()
    {
        return StationFactory::new();
    }

    public function nextStation(): BelongsTo
    {
        return $this->belongsTo(static::class, 'next_station_id');
    }

    public function previousStation(): BelongsTo
    {
        return $this->belongsTo(static::class, 'previous_station_id');
    }
}
