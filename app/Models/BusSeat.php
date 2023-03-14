<?php

namespace App\Models;

use Database\Factories\BusSeatFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property-read int $id
 * @property string $identifier
 * @property int bus_id
 * @property-read Bus $bus
 */

class BusSeat extends Model
{
    use HasFactory;

    protected static function newFactory()
    {
        return  BusSeatFactory::new();
    }

    public function bus(): BelongsTo
    {
        return $this->belongsTo(Bus::class);
    }
}
