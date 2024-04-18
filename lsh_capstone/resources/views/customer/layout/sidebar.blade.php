<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand py-1">
            <a href="{{ route('customer_home') }}">
                <img src="{{ asset('uploads/logo.png') }}" alt="" class="logo py-1">
            </a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('customer_home') }}"></a>
        </div>

        <ul class="sidebar-menu">

            <li class="{{ Request::is('customer/home') ? 'active' : '' }}"><a class="nav-link" href="{{ route('customer_home') }}"><i class="fa fa-tachometer"></i> <span>Dashboard</span></a></li>

            <li class="{{ Request::is('customer/order/view') ? 'active' : '' }}"><a class="nav-link" href="{{ route('customer_order_view') }}"><i class="fa fa-list-alt"></i> <span>Bookings</span></a></li>

            <li class="{{ Request::is('customer/review/view') ? 'active' : '' }}"><a class="nav-link" href="{{ route('customer_review_view') }}"><i class="fa fa-star"></i> <span>Reviews</span></a></li>

            <li class="{{ Request::is('customer/edit-profile') ? 'active' : '' }}"><a class="nav-link" href="{{ route('customer_profile') }}"><i class="fa fa-user"></i> <span>Edit Profile</span></a></li>

            <li><a class="nav-link" href="{{ route('home') }}" target="_blank"><i class="fa fa-home" aria-hidden="true"></i> <span>Visit Website</span></a></li>


            {{-- <li class="nav-item dropdown {{ Request::is('admin/amenity/view') || Request::is('admin/room/view') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown"><i class="fa fa-building-o"></i><span>Room Section</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('admin/amenity/view') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_amenity_view') }}"><i class="fa fa-angle-right"></i>Amenities</a></li>
                    <li class="{{ Request::is('admin/room/view') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_room_view') }}"><i class="fa fa-angle-right"></i>Rooms</a></li>
                </ul>
            </li> --}}

            

            
            {{-- <li class="{{ Request::is('admin/faq/view') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_faq_view') }}"><i class="fa fa-question-circle"></i> <span>FAQs</span></a></li> --}}

            
        </ul>
    </aside>
</div>