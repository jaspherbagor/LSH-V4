<?php

namespace App\Http\Controllers\Admin; // Define the namespace for the controller

use App\Http\Controllers\Controller; // Import the base controller class
use Illuminate\Http\Request; // Import the Request class
use App\Models\BookedRoom; // Import the BookedRoom model class

class AdminDatewiseRoomController extends Controller
{
    // Method to handle displaying the form for datewise rooms
    public function index()
    {
        // Return a view for the datewise rooms form
        return view('admin.datewise_rooms');
    }

    // Method to handle the form submission and showing datewise room details
    public function show(Request $request)
    {
        // Validate the incoming request data for the required selected_date field
        $request->validate([
            'selected_date' => 'required'
        ]);

        // Retrieve the selected date from the request
        $selected_date = $request->selected_date;

        // Return a view with the selected date data
        return view('admin.datewise_rooms_detail', compact('selected_date'));
    }
}
