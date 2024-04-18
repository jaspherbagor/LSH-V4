<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Accommodation;
use App\Models\AccommodationType;
use App\Models\Room;
use Illuminate\Http\Request;

class AccommodationController extends Controller
{
    public function index()
    {
        $accommodation_types = AccommodationType::get();
        return view('front.accommodation', compact('accommodation_types'));
    }

    public function accommodation_detail($accommtype_id)
    {
        $accommodation_type = AccommodationType::where('id', $accommtype_id)->first();
        $accommodation_all = Accommodation::where('accommodation_type_id', $accommtype_id)->get();
        return view('front.accommodation_detail', compact('accommodation_all', 'accommodation_type'));
    }
}
