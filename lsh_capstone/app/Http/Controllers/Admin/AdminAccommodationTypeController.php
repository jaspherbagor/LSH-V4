<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AccommodationType;
use Illuminate\Http\Request;

class AdminAccommodationTypeController extends Controller
{
    public function index()
    {
        $accommodation_types = AccommodationType::get();
        return view('admin.accommodation_type_view', compact('accommodation_types'));
    }

    public function add()
    {
        return view('admin.accommodation_type_add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'photo' => 'required|image|mimes:jpg,jpeg,png,svg,webp,gif|max:5120',
            'name' => 'required'
        ]);

        

        $ext = $request->file('photo')->extension();
        $final_name = time().'.'.$ext;

        $request->file('photo')->move(public_path('uploads/'),$final_name);

        $obj = new AccommodationType();
        $obj->photo = $final_name;
        $obj->name = $request->name;
        $obj->save();

        return redirect()->back()->with('success', 'Accommodation type is added successfully!');
    }

    public function edit($id)
    {
        $accommodation_type_data = AccommodationType::where('id',$id)->first();
        return view('admin.accommodation_type_edit', compact('accommodation_type_data'));
    }

    public function update(Request $request, $id)
    {
        $obj = AccommodationType::where('id', $id)->first();

        if($request->hasFile('photo')) {
            $request->validate([
                'photo' => 'image|mimes:jpeg,jpg,svg,png,webp,gif|max:5120',
            ]);

            unlink(public_path('uploads/'.$obj->photo));

            $ext = $request->file('photo')->extension();
            $final_name = time().'.'.$ext;

            $request->file('photo')->move(public_path('uploads/'),$final_name);


            $obj->photo = $final_name;           
        }

        $obj->name = $request->name;
        $obj->update();

        return redirect()->back()->with('success', 'Accommodation type is updated successfully!');
        
    }

    public function delete($id)
    {
        $single_data = AccommodationType::where('id', $id)->first();
        unlink(public_path('uploads/'.$single_data->photo));
        $single_data->delete();

        return redirect()->back()->with('success', 'Accommodation type is deleted successfully!');
    }
}
