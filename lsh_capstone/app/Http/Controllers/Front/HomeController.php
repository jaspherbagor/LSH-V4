<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Accommodation;
use App\Models\AccommodationType;
use App\Models\Feature;
use App\Models\Post;
use App\Models\Room;
use App\Models\Slide;
use App\Models\Testimonial;
use Illuminate\Http\Request;
class HomeController extends Controller
{
    public function index()
    {
        $testimonial_all = Testimonial::get();
        $slide_all = Slide::get();
        $feature_all = Feature::get();
        $post_all = Post::orderBy('id', 'desc')->limit(3)->get();
        $room_all = Room::orderBy('id', 'desc')->limit(4)->get();
        $accommodation_types = AccommodationType::get();
        return view('front.home',compact('slide_all', 'feature_all', 'testimonial_all', 'post_all', 'room_all', 'accommodation_types'));
    }
}
