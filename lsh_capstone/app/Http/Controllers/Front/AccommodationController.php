<?php
// Namespace declaration: specifies that this controller belongs to the 'App\Http\Controllers\Front' namespace
namespace App\Http\Controllers\Front;

// Importing necessary classes and models
use App\Http\Controllers\Controller; // Importing base controller class
use App\Models\Accommodation; // Importing the Accommodation model
use App\Models\AccommodationType; // Importing the AccommodationType model
use Illuminate\Http\Request; // Importing the Request class

// Controller for handling accommodation-related requests
class AccommodationController extends Controller
{
    // Method to display the list of accommodation types
    public function index()
    {
        // Retrieve all accommodation types from the database
        $accommodation_types = AccommodationType::get();
        
        // Render the 'front.accommodation' view and pass the retrieved accommodation types to it
        return view('front.accommodation', compact('accommodation_types'));
    }

    // Method to display details of a specific accommodation type
    public function accommodation_detail($accommtype_id)
    {
        // Retrieve the specific accommodation type based on the provided ID
        $accommodation_type = AccommodationType::where('id', $accommtype_id)->first();
        
        // Retrieve all accommodations associated with the specific accommodation type
        $accommodation_all = Accommodation::where('accommodation_type_id', $accommtype_id)->get();
        
        // Render the 'front.accommodation_detail' view and pass the retrieved accommodations and accommodation type to it
        return view('front.accommodation_detail', compact('accommodation_all', 'accommodation_type'));
    }
}
