<?php
// Namespace declaration: specifies that this controller belongs to the 'App\Http\Controllers\Front' namespace
namespace App\Http\Controllers\Front;

// Importing necessary classes and models
use App\Http\Controllers\Controller; // Importing base controller class
use App\Models\Accommodation; // Importing the Accommodation model
use App\Models\AccommodationRate; // Importing the AccommodationRate model
use App\Models\AccommodationType; // Importing the AccommodationType model
use App\Models\Room; // Importing the Room model
use Illuminate\Http\Request; // Importing the Request class

// Controller for handling room-related requests
class RoomController extends Controller
{
    // Method to display rooms for a specific accommodation based on the given accommodation ID
    public function index($accomm_id)
    {
        // Retrieve the specific accommodation by its ID
        $accommodation = Accommodation::where('id', $accomm_id)->first();
        
        // Retrieve the accommodation type associated with the accommodation
        $accommodation_type = AccommodationType::where('id', $accommodation->accommodation_type_id)->first();
        
        // Retrieve rooms associated with the accommodation and paginate them (12 rooms per page)
        $room_all = Room::where('accommodation_id', $accomm_id)->paginate(12);
        
        // Count the number of rooms associated with the accommodation
        $room_count = Room::where('accommodation_id', $accomm_id)->count();
        
        // Retrieve the rates associated with the accommodation
        $rates = AccommodationRate::where('accommodation_id', $accomm_id)->get();
        
        // Render the 'front.room' view and pass the retrieved data to it
        return view('front.room', compact('room_all', 'accommodation', 'accommodation_type', 'rates', 'room_count'));
    }

    // Method to display details of a single room based on the given room ID
    public function single_room($id)
    {
        // Retrieve the specific room data along with its photos
        $single_room_data = Room::with('RoomPhotos')->where('id', $id)->first();
        
        // Render the 'front.room_detail' view and pass the single room data to it
        return view('front.room_detail', compact('single_room_data'));
    }
}
