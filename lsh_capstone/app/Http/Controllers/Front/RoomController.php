<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Accommodation;
use App\Models\AccommodationRate;
use App\Models\AccommodationType;
use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function index($accomm_id)
    {
        $accommodation = Accommodation::where('id', $accomm_id)->first();
        $accommodation_type = AccommodationType::where('id', $accommodation->accommodation_type_id)->first();
        $room_all = Room::where('accommodation_id', $accomm_id)->paginate(12);
        $rates = AccommodationRate::where('accommodation_id', $accomm_id)->get();
        return view('front.room', compact('room_all', 'accommodation', 'accommodation_type', 'rates'));
    }

    public function single_room($id)
    {
        $single_room_data = Room::with('RoomPhotos')->where('id',$id)->first();
        return view('front.room_detail', compact('single_room_data'));
    }
}
