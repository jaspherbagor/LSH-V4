<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand py-1">
            <a href="{{ route('admin_home') }}">
                <img src="{{ asset('uploads/logo.png') }}" alt="" class="logo py-1">
            </a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('home') }}"></a>
        </div>

        <ul class="sidebar-menu">

            <li class="{{ Request::is('admin/home') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_home') }}"><i class="fa fa-tachometer"></i> <span>Dashboard</span></a></li>
            <li class="{{ Request::is('admin/edit-profile') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_profile') }}"><i class="fa fa-user-circle-o"></i> <span>Edit Profile</span></a></li>
            <li class="{{ Request::is('admin/setting') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_setting') }}"><i class="fa  fa-cogs"></i> <span>Setting</span></a></li>

            <li class="{{ Request::is('admin/datewise-rooms') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_datewise_rooms') }}"><i class="fa fa-calendar"></i> <span>Datewise Rooms</span></a></li>


            <li class="nav-item dropdown {{ Request::is('admin/amenity/view') || Request::is('admin/room/view') || Request::is('admin/accommodation-type/view') || Request::is('admin/accommodations') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown"><i class="fa fa-building-o"></i><span>Accommodation Section</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('admin/amenity/view') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_amenity_view') }}"><i class="fa fa-angle-right"></i>Amenities</a></li>
                    <li class="{{ Request::is('admin/accommodation-type/view') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_accommodation_type_view') }}"><i class="fa fa-angle-right"></i>Accommodation Types</a></li>
                    <li class="{{ Request::is('admin/accommodations') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_accommodation_all') }}"><i class="fa fa-angle-right"></i>All Accommodations</a></li>
                </ul>
            </li>

            <li class="nav-item dropdown {{ Request::is('admin/page/about') ||Request::is('admin/page/terms') ||Request::is('admin/page/privacy') ||Request::is('admin/page/contact') || Request::is('admin/page/photo-gallery') || Request::is('admin/page/video-gallery') || Request::is('admin/page/faq') || Request::is('admin/page/blog') ||Request::is('admin/page/room') || Request::is('admin/page/cart') || Request::is('admin/page/checkout') || Request::is('admin/page/payment') || Request::is('admin/page/signin') || Request::is('admin/page/signup') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown"><i class="fa fa-book"></i><span>Pages</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('admin/page/about') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_about_page') }}"><i class="fa fa-angle-right"></i> About</a></li>
                    <li class="{{ Request::is('admin/page/terms') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_terms_page') }}"><i class="fa fa-angle-right"></i> Terms and Conditions</a></li>
                    <li class="{{ Request::is('admin/page/privacy') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_privacy_page') }}"><i class="fa fa-angle-right"></i> Privacy Policy</a></li>
                    <li class="{{ Request::is('admin/page/contact') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_contact_page') }}"><i class="fa fa-angle-right"></i> Contact</a></li>
                    <li class="{{ Request::is('admin/page/photo-gallery') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_photo_gallery_page') }}"><i class="fa fa-angle-right"></i> Photo Gallery</a></li>
                    <li class="{{ Request::is('admin/page/video-gallery') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_video_gallery_page') }}"><i class="fa fa-angle-right"></i> Video Gallery</a></li>
                    <li class="{{ Request::is('admin/page/faq') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_faq_page') }}"><i class="fa fa-angle-right"></i> FAQs</a></li>
                    <li class="{{ Request::is('admin/page/blog') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_blog_page') }}"><i class="fa fa-angle-right"></i> Blog</a></li>
                    <li class="{{ Request::is('admin/page/room') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_room_page') }}"><i class="fa fa-angle-right"></i> Room</a></li>
                    <li class="{{ Request::is('admin/page/cart') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_cart_page') }}"><i class="fa fa-angle-right"></i> Cart</a></li>
                    <li class="{{ Request::is('admin/page/checkout') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_checkout_page') }}"><i class="fa fa-angle-right"></i> Checkout</a></li>
                    <li class="{{ Request::is('admin/page/payment') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_payment_page') }}"><i class="fa fa-angle-right"></i> Payment</a></li>
                    <li class="{{ Request::is('admin/page/signin') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_signin_page') }}"><i class="fa fa-angle-right"></i> Sign In</a></li>
                    <li class="{{ Request::is('admin/page/signup') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_signup_page') }}"><i class="fa fa-angle-right"></i> Sign Up</a></li>
                </ul>
            </li>

            <li class="{{ Request::is('admin/customer') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_customer') }}"><i class="fa fa-users"></i> <span>Customers</span></a></li>
            <li class="{{ Request::is('admin/order/view') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_order_view') }}"><i class="fa fa-list-alt"></i> <span>Bookings</span></a></li>

            <li class="{{ Request::is('admin/review/view') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_review_view') }}"><i class="fa fa-star"></i> <span>Accommodation Reviews</span></a></li>

            <li class="{{ Request::is('admin/slide/view') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_slide_view') }}"><i class="fa fa-sliders"></i> <span>Slide</span></a></li>

            <li class="{{ Request::is('admin/feature/view') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_feature_view') }}"><i class="fa fa-certificate"></i> <span>Feature</span></a></li>
            <li class="{{ Request::is('admin/testimonial/view') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_testimonial_view') }}"><i class="fa fa-star"></i> <span>Testimonial</span></a></li>
            <li class="{{ Request::is('admin/post/view') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_post_view') }}"><i class="fa fa-clipboard"></i> <span>Post</span></a></li>
            <li class="{{ Request::is('admin/photo/view') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_photo_view') }}"><i class="fa fa-picture-o"></i> <span>Photo Gallery</span></a></li>
            <li class="{{ Request::is('admin/video/view') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_video_view') }}"><i class="fa fa-video-camera"></i> <span>Video Gallery</span></a></li>
            <li class="{{ Request::is('admin/faq/view') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_faq_view') }}"><i class="fa fa-question-circle"></i> <span>FAQs</span></a></li>

            <li class="nav-item dropdown {{ Request::is('admin/subscriber/show') || Request::is('admin/subscriber/send-email') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown"><i class="fa fa-user-secret"></i><span>Subscribers</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('admin/subscriber/show') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_subscriber_show') }}"><i class="fa fa-angle-right"></i>All Subscribers</a></li>
                    <li class="{{ Request::is('admin/subscriber/send-email') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_subscriber_send_email') }}"><i class="fa fa-angle-right"></i>Send Email</a></li>
                </ul>
            </li>
        </ul>
    </aside>
</div>