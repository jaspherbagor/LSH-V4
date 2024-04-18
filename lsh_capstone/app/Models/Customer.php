<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Customer extends Authenticatable
{
    use HasFactory;

    public function accommodationRates()
    {
        return $this->hasMany(AccommodationRate::class, 'customer_id');
    }
}
