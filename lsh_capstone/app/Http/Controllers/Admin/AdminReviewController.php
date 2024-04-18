<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AccommodationRate;
use Illuminate\Http\Request;

class AdminReviewController extends Controller
{
    public function index()
    {
        $reviews = AccommodationRate::get();
        return view('admin.review_view', compact('reviews'));
    }

    public function delete($id)
    {
        $rate_data = AccommodationRate::where('id', $id)->first();
        $rate_data->delete();

        return redirect()->back()->with('success', 'Rate has been successfully deleted!');
    }
}
