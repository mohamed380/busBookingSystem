<?php

namespace App\Models;

use Database\Factories\StationFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property string $name
 */
class Station extends Model
{
    use HasFactory;

    protected static function newFactory()
    {
        return StationFactory::new();
    }
}
