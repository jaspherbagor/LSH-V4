<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;

class AdminPageController extends Controller
{
    // Handles the display of the "About" page in the admin area
    public function about()
    {
        // Retrieve the "About" page data from the database where the page ID is 1
        $about_data = Page::where('id', 1)->first();
        
        // Return the view for the admin "About" page with the retrieved data
        return view('admin.about_page', compact('about_data'));
    }

    // Handles updating the "About" page in the admin area
    public function about_update(Request $request)
    {
        // Retrieve the "About" page data from the database where the page ID is 1
        $obj = Page::where('id', 1)->first();

        // Update the "About" page data with values from the request
        $obj->about_heading = $request->about_heading;
        $obj->about_content = $request->about_content;
        $obj->about_status = $request->about_status;
        
        // Save the updated data back to the database
        $obj->update();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'About page is updated successfully!');
    }

    // Handles the display of the "Terms" page in the admin area
    public function terms()
    {
        // Retrieve the "Terms" page data from the database where the page ID is 1
        $terms_data = Page::where('id', 1)->first();
        
        // Return the view for the admin "Terms" page with the retrieved data
        return view('admin.terms_page', compact('terms_data'));
    }

    // Handles updating the "Terms" page in the admin area
    public function terms_update(Request $request)
    {
        // Retrieve the "Terms" page data from the database where the page ID is 1
        $obj = Page::where('id', 1)->first();

        // Update the "Terms" page data with values from the request
        $obj->terms_heading = $request->terms_heading;
        $obj->terms_content = $request->terms_content;
        $obj->terms_status = $request->terms_status;
        
        // Save the updated data back to the database
        $obj->update();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Terms page is updated successfully!');
    }


    // Handles the display of the "Privacy" page in the admin area
    public function privacy()
    {
        // Retrieve the "Privacy" page data from the database where the page ID is 1
        $privacy_data = Page::where('id', 1)->first();
        
        // Return the view for the admin "Privacy" page with the retrieved data
        return view('admin.privacy_page', compact('privacy_data'));
    }

    // Handles updating the "Privacy" page in the admin area
    public function privacy_update(Request $request)
    {
        // Retrieve the "Privacy" page data from the database where the page ID is 1
        $obj = Page::where('id', 1)->first();

        // Update the "Privacy" page data with values from the request
        $obj->privacy_heading = $request->privacy_heading;
        $obj->privacy_content = $request->privacy_content;
        $obj->privacy_status = $request->privacy_status;

        // Save the updated data back to the database
        $obj->update();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Privacy page is updated successfully!');
    }

    // Handles the display of the "Room" page in the admin area
    public function room()
    {
        // Retrieve the "Room" page data from the database where the page ID is 1
        $room_data = Page::where('id', 1)->first();
        
        // Return the view for the admin "Room" page with the retrieved data
        return view('admin.room_page', compact('room_data'));
    }

    // Handles updating the "Room" page in the admin area
    public function room_update(Request $request)
    {
        // Retrieve the "Room" page data from the database where the page ID is 1
        $obj = Page::where('id', 1)->first();

        // Update the "Room" page data with values from the request
        $obj->room_heading = $request->room_heading;

        // Save the updated data back to the database
        $obj->update();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Data is updated successfully.');
    }

    // Handles the display of the "Contact" page in the admin area
    public function contact()
    {
        // Retrieve the "Contact" page data from the database where the page ID is 1
        $contact_data = Page::where('id', 1)->first();
        
        // Return the view for the admin "Contact" page with the retrieved data
        return view('admin.contact_page', compact('contact_data'));
    }

    // Handles updating the "Contact" page in the admin area
    public function contact_update(Request $request)
    {
        // Retrieve the "Contact" page data from the database where the page ID is 1
        $obj = Page::where('id', 1)->first();

        // Update the "Contact" page data with values from the request
        $obj->contact_heading = $request->contact_heading;
        $obj->contact_map = $request->contact_map;
        $obj->contact_status = $request->contact_status;

        // Save the updated data back to the database
        $obj->update();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Contact page is updated successfully!');
    }

    // Handles the display of the "Photo Gallery" page in the admin area
    public function photo_gallery()
    {
        // Retrieve the "Photo Gallery" page data from the database where the page ID is 1
        $photo_gallery_data = Page::where('id', 1)->first();
        
        // Return the view for the admin "Photo Gallery" page with the retrieved data
        return view('admin.photo_gallery_page', compact('photo_gallery_data'));
    }

    // Handles updating the "Photo Gallery" page in the admin area
    public function photo_gallery_update(Request $request)
    {
        // Retrieve the "Photo Gallery" page data from the database where the page ID is 1
        $obj = Page::where('id', 1)->first();

        // Update the "Photo Gallery" page data with values from the request
        $obj->photo_gallery_heading = $request->photo_gallery_heading;
        $obj->photo_gallery_status = $request->photo_gallery_status;

        // Save the updated data back to the database
        $obj->update();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Photo gallery page is updated successfully!');
    }


    // Handles the display of the "Video Gallery" page in the admin area
    public function video_gallery()
    {
        // Retrieve the "Video Gallery" page data from the database where the page ID is 1
        $video_gallery_data = Page::where('id', 1)->first();
        
        // Return the view for the admin "Video Gallery" page with the retrieved data
        return view('admin.video_gallery_page', compact('video_gallery_data'));
    }

    // Handles updating the "Video Gallery" page in the admin area
    public function video_gallery_update(Request $request)
    {
        // Retrieve the "Video Gallery" page data from the database where the page ID is 1
        $obj = Page::where('id', 1)->first();

        // Update the "Video Gallery" page data with values from the request
        $obj->video_gallery_heading = $request->video_gallery_heading;
        $obj->video_gallery_status = $request->video_gallery_status;

        // Save the updated data back to the database
        $obj->update();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Video gallery page is updated successfully!');
    }

    // Handles the display of the "FAQ" page in the admin area
    public function faq()
    {
        // Retrieve the "FAQ" page data from the database where the page ID is 1
        $faq_data = Page::where('id', 1)->first();
        
        // Return the view for the admin "FAQ" page with the retrieved data
        return view('admin.faq_page', compact('faq_data'));
    }

    // Handles updating the "FAQ" page in the admin area
    public function faq_update(Request $request)
    {
        // Retrieve the "FAQ" page data from the database where the page ID is 1
        $obj = Page::where('id', 1)->first();

        // Update the "FAQ" page data with values from the request
        $obj->faq_heading = $request->faq_heading;
        $obj->faq_status = $request->faq_status;

        // Save the updated data back to the database
        $obj->update();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'FAQ page is updated successfully!');
    }



    public function blog()
    {
        $blog_data = Page::where('id',1)->first();
        return view('admin.blog_page', compact('blog_data'));
    }

    public function blog_update(Request $request)
    {
        $obj = Page::where('id',1)->first();


        $obj->blog_heading = $request->blog_heading;
        $obj->blog_status = $request->blog_status;
        $obj->update();

        return redirect()->back()->with('success', 'Blog page is updated successfully!');
    }



    public function cart()
    {
        $cart_data = Page::where('id',1)->first();
        return view('admin.cart_page', compact('cart_data'));
    }

    public function cart_update(Request $request)
    {
        $obj = Page::where('id',1)->first();


        $obj->cart_heading = $request->cart_heading;
        $obj->cart_status = $request->cart_status;
        $obj->update();

        return redirect()->back()->with('success', 'Cart page is updated successfully!');
    }



    public function checkout()
    {
        $checkout_data = Page::where('id',1)->first();
        return view('admin.checkout_page', compact('checkout_data'));
    }

    public function checkout_update(Request $request)
    {
        $obj = Page::where('id',1)->first();


        $obj->checkout_heading = $request->checkout_heading;
        $obj->checkout_status = $request->checkout_status;
        $obj->update();

        return redirect()->back()->with('success', 'Checkout page is updated successfully!');
    }


    public function payment()
    {
        $payment_data = Page::where('id',1)->first();
        return view('admin.payment_page', compact('payment_data'));
    }

    public function payment_update(Request $request)
    {
        $obj = Page::where('id',1)->first();


        $obj->payment_heading = $request->payment_heading;
        $obj->update();

        return redirect()->back()->with('success', 'Payment page is updated successfully!');
    }

    public function signin()
    {
        $signin_data = Page::where('id',1)->first();
        return view('admin.signin_page', compact('signin_data'));
    }

    public function signin_update(Request $request)
    {
        $obj = Page::where('id',1)->first();


        $obj->signin_heading = $request->signin_heading;
        $obj->signin_status = $request->signin_status;
        $obj->update();

        return redirect()->back()->with('success', 'Sign in page is updated successfully!');
    }

    public function signup()
    {
        $signup_data = Page::where('id',1)->first();
        return view('admin.signup_page', compact('signup_data'));
    }

    public function signup_update(Request $request)
    {
        $obj = Page::where('id',1)->first();


        $obj->signup_heading = $request->signup_heading;
        $obj->signup_status = $request->signup_status;
        $obj->update();

        return redirect()->back()->with('success', 'Sign up page is updated successfully!');
    }
}
