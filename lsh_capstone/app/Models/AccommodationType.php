<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccommodationType extends Model
{
    use HasFactory;

    /**
     * Get the accommodations for the accommodation type.
     */
    public function accommodations()
    {
        return $this->hasMany(Accommodation::class);
    }
}
