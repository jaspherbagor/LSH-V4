<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Accommodation extends Model
{
    use HasFactory;

    /**
     * Get the accommodation type that owns the accommodation.
     */
    public function accommodationType()
    {
        return $this->belongsTo(AccommodationType::class);
    }

    /**
     * Get the rooms for the accommodation.
     */
    public function rooms()
    {
        return $this->hasMany(Room::class);
    }

    public function accommodationRates()
    {
        return $this->hasMany(AccommodationRate::class, 'accommodation_id');
    }
}
