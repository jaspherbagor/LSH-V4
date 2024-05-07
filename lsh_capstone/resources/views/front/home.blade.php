@extends('front.layout.app')

@section('main_content')
<div class="slider">
    <div class="slide-carousel owl-carousel">

        @foreach($slide_all as $item)
        <div class="item" style="background-image:url({{ asset('uploads/'.$item->photo) }});">
            <div class="bg"></div>
            <div class="text">
                <h2>{{ $item->heading }}</h2>
                <p>{!! $item->text !!}</p>

                @if($item->button_text !== '')
                <div class="button">
                    <a href="{{ $item->button_url }}">{{ $item->button_text }}</a>
                </div>
                @endif
            </div>
        </div>
        @endforeach
    </div>
</div>
     
 
<div class="search-section">
    <div class="container">
        <form action="{{ route('cart_submit') }}" method="post">
            @csrf
        <div class="inner">
            <div class="row">
                <div class="col-lg-3">
                    <div class="form-group">
                        <select name="room_id" class="form-select">
                            <option value="">Select Room</option>
                            @foreach($room_all as $item)
                            @php
                            $accommodation = \App\Models\Accommodation::where('id', $item->accommodation_id)->first();
                            @endphp
                            <option value="{{ $item->id }}">{{ $item->room_name }} - (<span class="text-success">{{ $accommodation->name }}</span>)  </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-group">
                        <input type="text" name="checkin_checkout" class="form-control daterange1" placeholder="Arrival & Departure">
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="form-group">
                        <input type="number" name="adult" class="form-control" min="1" max="30" placeholder="Adults">
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="form-group">
                        <input type="number" name="children" class="form-control" min="0" max="30" placeholder="Children">
                    </div>
                </div>
                <div class="col-lg-2">
                    <button type="submit" class="btn btn-primary">Book Now</button>
                </div>
            </div>
        </div>
        </form>
    </div>
</div>



@if($global_setting_data->home_feature_status == 'Show')
<div class="home-feature">
    <div class="container">
        <div class="row">
            
            @foreach($feature_all as $item)
            <div class="col-md-3 col-sm-6">
                <div class="inner">
                    <div class="icon"><i class="{{ $item->icon }}"></i></div>
                    <div class="text">
                        <h2>{{ $item->heading }}</h2>
                        <p>
                            {!! $item->text !!}
                        </p>
                    </div>
                </div>
            </div>
            @endforeach

        </div>
    </div>
</div>
@endif

<div class="home-rooms">
    <div class="container">
        <div class="row mb-4">
            <div class="col-md-12">
                <h2 class="main-header">Accommodation Types</h2>
            </div>
        </div>
        <div class="row">
            @foreach($accommodation_types as $item)
            <div class="col-md-4">
                <div class="inner">
                    <div class="card home-card">
                        <div class="photo card-img-top">
                            <img src="{{ asset('uploads/'.$item->photo) }}" alt="" class="img-fluid">
                        </div>
                        <div class="text card-body">
                            <h2>
                                <a href="{{ route('accommodation_detail',$item->id) }}">{{ $item->name }}</a>
                            </h2>
                            <div class="button">
                                <a href="{{ route('accommodation_detail',$item->id) }}" class="btn btn-primary"><i class="fa fa-eye" aria-hidden="true"></i> View Accommodations</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach            
        </div>
    </div>
</div>


@if($global_setting_data->home_room_status == 'Show')
<div class="home-rooms">
    <div class="container">
        <div class="row mb-4">
            <div class="col-md-12">
                <h2 class="main-header">Featured Accommodation Rooms</h2>
            </div>
        </div>
        <div class="row">

            @foreach($room_all as $item)
            @php
                $accommodation = \App\Models\Accommodation::where('id', $item->accommodation_id)->first();
                $accommodation_type = \App\Models\AccommodationType::where('id',$accommodation->accommodation_type_id)->first();
            @endphp
            <div class="col-md-3">
                <div class="inner">
                    <div class="card home-card">
                        <div class="photo card-img-top">
                            <img src="{{ asset('uploads/'.$item->featured_photo) }}" alt="">
                        </div>
                        <div class="text card-body">
                            <h2>
                                <a href="{{ route('room_detail',$item->id) }}">{{ $item->room_name }}</a>
                            </h2>
                            <p class="my-3">
                                <a href="{{ route('room', $accommodation->id) }}" class="text-secondary fw-semibold">
                                    {{ $accommodation->name }}
                                </a>
                            </p>
                            <div class="price">
                                @if($accommodation_type->name != 'Hotel')
                                ₱{{ number_format($item->price, 2) }} per month
                                @else
                                ₱{{ number_format($item->price, 2) }} per night
                                @endif
                            </div>
                            <div class="button">
                                <a href="{{ route('room_detail',$item->id) }}" class="btn btn-primary"><i class="fa fa-eye" aria-hidden="true"></i> View Detail</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
    </div>
</div>
@endif

@if($global_setting_data->home_testimonial_status == 'Show')
<div class="testimonial" style="background-image: url(uploads/slide1.jpg)">
    <div class="bg"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="main-header">Our Happy Clients</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="testimonial-carousel owl-carousel">

                    @foreach($testimonial_all as $item)
                    <div class="item">
                        <div class="photo">
                            <img src="{{ asset('uploads/'.$item->photo) }}" alt="testimonial image">
                        </div>
                        <div class="text">
                            <h4>{{ $item->name }}</h4>
                            <p>{{ $item->designation }}</p>
                        </div>
                        <div class="description px-md-5 px-1">
                            <p>
                                {!! $item->comment !!} 
                            </p>
                        </div>
                    </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</div>
@endif


@if($global_setting_data->home_latest_post_status == 'Show')
<div class="blog-item">
    <div class="container">
        <div class="row mb-4">
            <div class="col-md-12">
                <h2 class="main-header">Latest Posts</h2>
            </div>
        </div>
        <div class="row">

            @foreach($post_all as $item)
            @if($loop->iteration>$global_setting_data->home_latest_post_total) 
            @break
            @endif
            <div class="col-md-4">
                <div class="inner">
                    <div class="card home-card">
                        <div class="photo card-img-top">
                            <img src="{{ asset('uploads/'.$item->photo) }}" alt="" class="img-fluid">
                        </div>
                        <div class="text card-body">
                            <h2><a href="{{ route('single_post',$item->id) }}">{{ $item->heading }}</a></h2>
                            <div class="short-des">
                                <p>
                                    {!! $item->short_content !!}
                                </p>
                            </div>
                            <div class="button">
                                <a href="{{ route('single_post',$item->id) }}" class="btn btn-primary"><i class="fa fa-eye" aria-hidden="true"></i> Read More</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            
        </div>
    </div>
</div>
@endif


@if($errors->any())
    @foreach($errors->all() as $error)
        <script>
            iziToast.error({
                title: '',
                position: 'topRight',
                message: '{{ $error }}',
            });
        </script>
    @endforeach
@endif
@endsection