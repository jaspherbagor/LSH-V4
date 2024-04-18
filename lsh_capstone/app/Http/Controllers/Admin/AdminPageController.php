<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;

class AdminPageController extends Controller
{
    public function about()
    {
        $about_data = Page::where('id',1)->first();
        return view('admin.about_page', compact('about_data'));
    }

    public function about_update(Request $request)
    {
        $obj = Page::where('id',1)->first();


        $obj->about_heading = $request->about_heading;
        $obj->about_content = $request->about_content;
        $obj->about_status = $request->about_status;
        $obj->update();

        return redirect()->back()->with('success', 'About page is updated successfully!');
    }

    public function terms()
    {
        $terms_data = Page::where('id',1)->first();
        return view('admin.terms_page', compact('terms_data'));
    }

    public function terms_update(Request $request)
    {
        $obj = Page::where('id',1)->first();


        $obj->terms_heading = $request->terms_heading;
        $obj->terms_content = $request->terms_content;
        $obj->terms_status = $request->terms_status;
        $obj->update();

        return redirect()->back()->with('success', 'Terms page is updated successfully!');
    }

    public function privacy()
    {
        $privacy_data = Page::where('id',1)->first();
        return view('admin.privacy_page', compact('privacy_data'));
    }

    public function privacy_update(Request $request)
    {
        $obj = Page::where('id',1)->first();


        $obj->privacy_heading = $request->privacy_heading;
        $obj->privacy_content = $request->privacy_content;
        $obj->privacy_status = $request->privacy_status;
        $obj->update();

        return redirect()->back()->with('success', 'Privacy page is updated successfully!');
    }

    public function room()
    {
        $room_data = Page::where('id',1)->first();
        return view('admin.room_page', compact('room_data'));
    }

    public function room_update(Request $request)
    {
        $obj = Page::where('id',1)->first();
        $obj->room_heading = $request->room_heading;
        $obj->update();

        return redirect()->back()->with('success', 'Data is updated successfully.');
    }










    public function contact()
    {
        $contact_data = Page::where('id',1)->first();
        return view('admin.contact_page', compact('contact_data'));
    }

    public function contact_update(Request $request)
    {
        $obj = Page::where('id',1)->first();


        $obj->contact_heading = $request->contact_heading;
        $obj->contact_map = $request->contact_map;
        $obj->contact_status = $request->contact_status;
        $obj->update();

        return redirect()->back()->with('success', 'Contact page is updated successfully!');
    }

    public function photo_gallery()
    {
        $photo_gallery_data = Page::where('id',1)->first();
        return view('admin.photo_gallery_page', compact('photo_gallery_data'));
    }

    public function photo_gallery_update(Request $request)
    {
        $obj = Page::where('id',1)->first();


        $obj->photo_gallery_heading = $request->photo_gallery_heading;
        $obj->photo_gallery_status = $request->photo_gallery_status;
        $obj->update();

        return redirect()->back()->with('success', 'Photo gallery page is updated successfully!');
    }


    public function video_gallery()
    {
        $video_gallery_data = Page::where('id',1)->first();
        return view('admin.video_gallery_page', compact('video_gallery_data'));
    }

    public function video_gallery_update(Request $request)
    {
        $obj = Page::where('id',1)->first();


        $obj->video_gallery_heading = $request->video_gallery_heading;
        $obj->video_gallery_status = $request->video_gallery_status;
        $obj->update();

        return redirect()->back()->with('success', 'Video gallery page is updated successfully!');
    }

    public function faq()
    {
        $faq_data = Page::where('id',1)->first();
        return view('admin.faq_page', compact('faq_data'));
    }

    public function faq_update(Request $request)
    {
        $obj = Page::where('id',1)->first();


        $obj->faq_heading = $request->faq_heading;
        $obj->faq_status = $request->faq_status;
        $obj->update();

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
