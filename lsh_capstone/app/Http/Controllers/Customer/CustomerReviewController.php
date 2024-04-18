<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Accommodation;
use App\Models\AccommodationRate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerReviewController extends Controller
{
    public function index()
    {
        $rates = AccommodationRate::where('customer_id', Auth::guard('customer')->user()->id)->get();

        return view('customer.review_view', compact('rates'));
    }

    public function  add_review($id)
    {
        $accommodation = Accommodation::where('id', $id)->first();
        return view('customer.review_add', compact('accommodation'));
    }

    public function review_store(Request $request, $id)
    {
        $request->validate([
            'review_heading' => 'required',
            'rate' => 'required',
            'review_description' => 'required'
        ]);

        $review_data = new AccommodationRate();
        $review_data->customer_id = Auth::guard('customer')->user()->id;
        $review_data->accommodation_id = $id;
        $review_data->rate = $request->rate;
        $review_data->review_heading = $request->review_heading;
        $review_data->review_description = $request->review_description;
        $review_data->save();

        return redirect()->back()->with('success', 'Review for accommodation has been submitted successfully!');
    }

    public function review_edit($id)
    {
        $review_data = AccommodationRate::where('accommodation_id', $id)->first();
        return view('customer.review_edit', compact('review_data'));
    }

    public function review_update(Request $request, $id)
    {
        $review_data = AccommodationRate::where('accommodation_id', $id)->first();

        $review_data->rate = $request->rate;
        $review_data->review_heading = $request->review_heading;
        $review_data->review_description = $request->review_description;
        $review_data->update();

        return redirect()->back()->with('success', 'Review has been successfully updated!');
    }

    public function review_delete($id)
    {
        $review_data = AccommodationRate::where('id', $id)->first();
        $review_data->delete();

        return redirect()->back()->with('success', 'Review has been successfully deleted!');
    }

}
