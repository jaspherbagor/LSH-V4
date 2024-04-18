@extends('front.layout.app')

@section('main_content')
<div class="page-top">
    <div class="bg"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>All Accommodation Types</h2>
            </div>
        </div>
    </div>
</div>

<div class="home-rooms">
    <div class="container">
        <div class="row">
            @foreach($accommodation_types as $item)
            <div class="col-md-4">
                <div class="inner">
                    <div class="card accommodation-types-card">
                        <div class="photo card-img-top">
                            <img src="{{ asset('uploads/'.$item->photo) }}" alt="">
                        </div>
                        <div class="text card-body">
                            <h2><a href="{{ route('accommodation_detail',$item->id) }}">{{ $item->name }}</a></h2>
                            <div class="button">
                                <a href="{{ route('accommodation_detail',$item->id) }}" class="btn btn-primary">See Accommodations</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection