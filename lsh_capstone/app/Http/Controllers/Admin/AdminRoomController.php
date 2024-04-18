<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Accommodation;
use App\Models\AccommodationType;
use App\Models\Amenity;
use App\Models\Room;
use App\Models\RoomPhoto;
use Illuminate\Http\Request;

class AdminRoomController extends Controller
{
    public function index($accom_id)
    {
        $accommodation_type = AccommodationType::where('id', $accom_id)->first();
        $accommodation = Accommodation::where('id', $accom_id)->first();
        $rooms = Room::where('accommodation_id', $accom_id)->get();
        return view('admin.room_view', compact('rooms', 'accommodation', 'accommodation_type'));
    }

    public function add($accom_id)
    {
        $accommodation = Accommodation::where('id', $accom_id)->first();
        $accommodation_type = AccommodationType::where('id', $accommodation->accommodation_type_id)->first();
        $all_amenities = Amenity::get();
        return view('admin.room_add',compact('all_amenities', 'accommodation', 'accommodation_type'));
    }

    public function store(Request $request, $accom_id)
    {
        $amenities = '';
        $i=0;
        if(isset($request->arr_amenities)) {
            foreach($request->arr_amenities as $item) {
                if($i==0) {
                    $amenities .= $item;
                } else {
                    $amenities .= ','.$item;
                }            
                $i++;
            }
        }

        $request->validate([
            'featured_photo' => 'required|image|mimes:jpg,jpeg,png,gif',
            'room_name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'total_rooms' => 'required'
        ]);

        $ext = $request->file('featured_photo')->extension();
        $final_name = time().'.'.$ext;
        $request->file('featured_photo')->move(public_path('uploads/'),$final_name);

        $obj = new Room();
        $obj->accommodation_id = $accom_id;
        $obj->featured_photo = $final_name;
        $obj->room_name = $request->room_name;
        $obj->description = $request->description;
        $obj->price = $request->price;
        $obj->total_rooms = $request->total_rooms;
        $obj->amenities = $amenities;
        $obj->size = $request->size;
        $obj->total_beds = $request->total_beds;
        $obj->total_bathrooms = $request->total_bathrooms;
        $obj->total_balconies = $request->total_balconies;
        $obj->total_guests = $request->total_guests;
        $obj->video_id = $request->video_id;
        $obj->save();

        return redirect()->back()->with('success', 'Room is added successfully.');

    }

    public function edit($id)
    {
        $all_amenities = Amenity::get();
        $room_data = Room::where('id',$id)->first();

        $existing_amenities = array();
        if($room_data->amenities != '') {
            $existing_amenities = explode(',',$room_data->amenities);
        }
        return view('admin.room_edit', compact('room_data','all_amenities','existing_amenities'));
    }

    public function update(Request $request,$id) 
    {        
        $obj = Room::where('id',$id)->first();

        $amenities = '';
        $i=0;
        if(isset($request->arr_amenities)) {
            foreach($request->arr_amenities as $item) {
                if($i==0) {
                    $amenities .= $item;
                } else {
                    $amenities .= ','.$item;
                }            
                $i++;
            }
        }

        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'total_rooms' => 'required'
        ]);

        if($request->hasFile('featured_photo')) {
            $request->validate([
                'featured_photo' => 'image|mimes:jpg,jpeg,png,gif'
            ]);
            unlink(public_path('uploads/'.$obj->featured_photo));
            $ext = $request->file('featured_photo')->extension();
            $final_name = time().'.'.$ext;
            $request->file('featured_photo')->move(public_path('uploads/'),$final_name);
            $obj->featured_photo = $final_name;
        }

        $obj->room_name = $request->room_name;
        $obj->description = $request->description;
        $obj->price = $request->price;
        $obj->total_rooms = $request->total_rooms;
        $obj->amenities = $amenities;
        $obj->size = $request->size;
        $obj->total_beds = $request->total_beds;
        $obj->total_bathrooms = $request->total_bathrooms;
        $obj->total_balconies = $request->total_balconies;
        $obj->total_guests = $request->total_guests;
        $obj->video_id = $request->video_id;
        $obj->update();

        return redirect()->back()->with('success', 'Room is updated successfully.');
    }

    public function delete($id)
    {
        $single_data = Room::where('id',$id)->first();
        unlink(public_path('uploads/'.$single_data->featured_photo));
        $single_data->delete();

        $room_photo_data = RoomPhoto::where('room_id',$id)->get();
        foreach($room_photo_data as $item) {
            unlink(public_path('uploads/'.$item->photo));
            $item->delete();
        }

        return redirect()->back()->with('success', 'Room is deleted successfully.');
    }

    public function gallery($id)
    {
        $room_data = Room::where('id',$id)->first();
        $room_photos = RoomPhoto::where('room_id',$id)->get();
        return view('admin.room_gallery', compact('room_data','room_photos'));
    }

    public function gallery_store(Request $request,$id)
    {
        $request->validate([
            'photo' => 'required|image|mimes:jpg,jpeg,png,gif'
        ]);

        $ext = $request->file('photo')->extension();
        $final_name = time().'.'.$ext;
        $request->file('photo')->move(public_path('uploads/'),$final_name);

        $obj = new RoomPhoto();
        $obj->photo = $final_name;
        $obj->room_id = $id;
        $obj->save();

        return redirect()->back()->with('success', 'Photo is added successfully.');
    }

    public function gallery_delete($id)
    {
        $single_data = RoomPhoto::where('id',$id)->first();
        unlink(public_path('uploads/'.$single_data->photo));
        $single_data->delete();

        return redirect()->back()->with('success', 'Photo is deleted successfully.');
    }
}
